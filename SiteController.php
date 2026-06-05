<?php
namespace App\Controller;

use App\Repository\MovieRepository;
use App\Repository\MessageRepository;
use App\Repository\SettingRepository;

class SiteController extends BaseController
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

    public function handleRequest(): void
    {
        $genre = $this->get('genre', '');
        $search = $this->get('q', '');
        $contactStatus = '';
        $contactError = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['msg_submit'])) {
            $name = $this->post('msg_name');
            $contact = $this->post('msg_contact');
            $message = $this->post('msg_message');

            if ($name === '' || $message === '') {
                $contactError = 'Name and message are required.';
            } else {
                $this->messages->save($name, $contact, $message);
                $contactStatus = 'Message sent! We will get back to you shortly.';
            }
        }

        $this->render('home.php', [
            'featured' => $this->movies->getFeatured(),
            'movies' => $this->movies->getMovies($genre, $search),
            'genres' => $this->movies->getGenres(),
            'genre' => $genre,
            'search' => $search,
            'totalViews' => $this->movies->getTotalViews(),
            'siteDescription' => $this->settings->get('site_description', 'Watch the latest movies online for free'),
            'channelUrl' => $this->settings->get('channel_url', CHANNEL_URL),
            'waNumber' => $this->settings->get('wa_number', WA_NUMBER),
            'contactStatus' => $contactStatus,
            'contactError' => $contactError,
        ]);
    }
}
