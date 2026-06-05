<?php
namespace App\Controller;

use App\Auth;
use App\FileUploader;
use App\Repository\MovieRepository;
use App\Repository\MessageRepository;
use App\Repository\SettingRepository;

class AdminController extends BaseController
{
    private MovieRepository $movies;
    private MessageRepository $messages;
    private SettingRepository $settings;

    public function __construct()
    {
        $this->movies = new MovieRepository();
        $this->messages = new MessageRepository();
        $this->settings = new SettingRepository();
    }

    public function handleLogin(): void
    {
        if (Auth::isAdmin()) {
            $this->redirect('admin/index.php');
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->post('username');
            $pass = $this->post('password');

            if (Auth::login($user, $pass)) {
                $this->redirect('admin/index.php');
            }

            $error = 'Incorrect username or password.';
        }

        $this->render('admin/login.php', ['error' => $error]);
    }

    public function handleRequest(): void
    {
        Auth::requireAdmin();

        $tab = $this->get('tab', 'dashboard');
        $messages = $this->messages->getAll();
        $unreadCount = $this->messages->countUnread();
        $topMovies = $this->movies->getTopMovies();
        $genreStats = $this->movies->getGenreStats();
        $allMovies = $this->movies->getMovies();

        $uploadMessage = '';
        $uploadError = '';
        $settingsMessage = '';
        $settingsError = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_submit'])) {
            $uploadError = $this->handleUpload();
            if ($uploadError === '') {
                $uploadMessage = 'Movie uploaded successfully!';
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['settings_submit'])) {
            [$settingsMessage, $settingsError] = $this->handleSettings();
        }

        if ($this->get('delete') !== '') {
            $this->movies->delete((int) $this->get('delete'));
            $this->redirect('?tab=movies');
        }

        if ($this->get('toggle_featured') !== '') {
            $this->movies->setFeatured((int) $this->get('toggle_featured'));
            $this->redirect('?tab=movies');
        }

        if ($this->get('del_msg') !== '') {
            $this->messages->delete((int) $this->get('del_msg'));
            $this->redirect('?tab=messages');
        }

        $this->messages->markAllRead();

        $this->render('admin/index.php', [
            'tab' => $tab,
            'error' => '',
            'uploadMessage' => $uploadMessage,
            'uploadError' => $uploadError,
            'settingsMessage' => $settingsMessage,
            'settingsError' => $settingsError,
            'topMovies' => $topMovies,
            'genreStats' => $genreStats,
            'allMovies' => $allMovies,
            'totalMovies' => $this->movies->countMovies(),
            'totalViews' => $this->movies->getTotalViews(),
            'totalMsgs' => $this->messages->count(),
            'unreadMsgs' => $unreadCount,
            'waNumber' => $this->settings->get('wa_number', WA_NUMBER),
            'channelUrl' => $this->settings->get('channel_url', CHANNEL_URL),
            'siteDesc' => $this->settings->get('site_description', 'Watch the latest movies online for free'),
            'adminUser' => $this->settings->get('admin_username', 'admin'),
            'messages' => $messages,
        ]);
    }

    private function handleUpload(): string
    {
        $title = $this->post('title');
        $genre = $this->post('genre') ?: 'Other';
        $year = (int) $this->post('year');
        $duration = $this->post('duration');
        $description = $this->post('description');
        $featured = isset($_POST['featured']) ? 1 : 0;

        if ($title === '') {
            return 'Movie title is required.';
        }

        $videoResult = FileUploader::upload($_FILES['video_file'] ?? [], ALLOWED_VIDEO_EXTENSIONS, UPLOAD_VIDEO_DIR, MAX_VIDEO_SIZE);
        if (!$videoResult['success']) {
            return $videoResult['error'];
        }

        $thumbResult = FileUploader::upload($_FILES['thumbnail'] ?? [], ALLOWED_IMAGE_EXTENSIONS, UPLOAD_THUMB_DIR);
        if (!$thumbResult['success']) {
            return $thumbResult['error'];
        }

        $movieId = $this->movies->create([
            'title' => $title,
            'genre' => $genre,
            'year' => $year,
            'duration' => $duration,
            'description' => $description,
            'video_file' => $videoResult['filename'],
            'thumbnail' => $thumbResult['filename'],
            'featured' => $featured,
        ]);

        if ($featured && $movieId > 0) {
            $this->movies->setFeatured($movieId);
        }

        return '';
    }

    private function handleSettings(): array
    {
        $waNumber = $this->post('wa_number');
        $channelUrl = $this->post('channel_url');
        $siteDesc = $this->post('site_desc');
        $newUser = $this->post('new_username');
        $newPass = $this->post('new_password');
        $confirmPass = $this->post('confirm_password');

        $this->settings->set('wa_number', $waNumber);
        $this->settings->set('channel_url', $channelUrl);
        $this->settings->set('site_description', $siteDesc);

        if ($newUser !== '') {
            $this->settings->set('admin_username', $newUser);
        }

        if ($newPass !== '') {
            if ($newPass !== $confirmPass) {
                return ['', 'Passwords do not match.'];
            }

            $hash = password_hash($newPass, PASSWORD_DEFAULT);
            $this->settings->set('admin_password', $hash);
        }

        return ['Settings saved successfully.', ''];
    }
}
