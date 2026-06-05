<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard — FreeWatch</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root{--bg:#080c14;--surface:#0f1724;--card:#141e2e;--border:rgba(255,255,255,0.07);--gold:#f5a623;--gold2:#ffcc66;--text:#e8eaf0;--muted:#7a8499;--red:#e63946;--green:#2ec27e;--blue:#4da6ff;}
*{margin:0;padding:0;box-sizing:border-box;}
body{background:var(--bg);color:var(--text);font-family:'DM Sans',sans-serif;min-height:100vh;}
.topbar{background:rgba(8,12,20,.95);backdrop-filter:blur(14px);border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;padding:0 18px;height:60px;position:sticky;top:0;z-index:100;}
.tlogo{font-family:'Bebas Neue',sans-serif;font-size:22px;color:var(--gold);letter-spacing:2px;}
.tlogo span{color:var(--muted);font-size:12px;font-family:'DM Sans',sans-serif;font-weight:400;margin-left:8px;}
.tactions{display:flex;gap:8px;align-items:center;}
.tactions a{color:var(--muted);text-decoration:none;font-size:13px;padding:6px 12px;border-radius:8px;border:1px solid var(--border);transition:all .2s;}
.tactions a:hover{color:var(--text);border-color:rgba(255,255,255,.15);}
.btn-logout{background:transparent;border:1px solid rgba(230,57,70,.3);color:var(--red);font-size:13px;padding:6px 14px;border-radius:8px;cursor:pointer;transition:all .2s;}
.btn-logout:hover{background:rgba(230,57,70,.1);}
.nav-tabs{display:flex;gap:0;padding:0 18px;border-bottom:1px solid var(--border);overflow-x:auto;scrollbar-width:none;}
.nav-tabs::-webkit-scrollbar{display:none;}
.ntab{padding:14px 18px;font-size:14px;font-weight:500;cursor:pointer;color:var(--muted);border-bottom:2px solid transparent;white-space:nowrap;transition:all .2s;text-decoration:none;display:flex;align-items:center;gap:7px;}
.ntab:hover{color:var(--text);}
.ntab.active{color:var(--gold);border-bottom-color:var(--gold);}
.badge-count{background:var(--red);color:#fff;font-size:10px;font-weight:700;padding:1px 6px;border-radius:10px;}
.panel{display:none;padding:22px 18px 80px;}
.panel.active{display:block;}
.stats-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px;margin-bottom:24px;}
.scard{background:var(--surface);border-radius:14px;border:1px solid var(--border);padding:18px 16px;}
.scard .sv{font-size:30px;font-weight:700;color:var(--gold);font-family:'Bebas Neue',sans-serif;letter-spacing:1px;}
.scard .sl{font-size:12px;color:var(--muted);margin-top:2px;}
.scard .si{font-size:22px;margin-bottom:4px;}
.tbox{background:var(--surface);border-radius:14px;border:1px solid var(--border);padding:18px;margin-bottom:18px;}
.tbox-title{font-family:'Bebas Neue',sans-serif;font-size:18px;color:var(--gold);letter-spacing:1px;margin-bottom:16px;}
table{width:100%;border-collapse:collapse;font-size:13px;}
th{text-align:left;padding:9px 12px;font-size:11px;color:var(--muted);font-weight:500;border-bottom:1px solid var(--border);white-space:nowrap;}
td{padding:11px 12px;border-bottom:1px solid rgba(255,255,255,.03);vertical-align:middle;}
tr:last-child td{border-bottom:none;}
tr:hover td{background:rgba(255,255,255,.02);}
.gtag{font-size:11px;background:rgba(245,166,35,.12);color:var(--gold);padding:2px 8px;border-radius:5px;}
.vbar-wrap{display:inline-block;vertical-align:middle;margin-left:6px;width:60px;height:5px;background:var(--card);border-radius:3px;overflow:hidden;}
.vbar{height:100%;background:var(--gold);border-radius:3px;}
.empty-row td{text-align:center;padding:28px;color:var(--muted);}
.ubox{background:var(--surface);border-radius:16px;border:1px solid var(--border);padding:22px 18px;margin-bottom:18px;}
.ubox h2{font-family:'Bebas Neue',sans-serif;font-size:18px;color:var(--gold);letter-spacing:1px;margin-bottom:18px;}
.fg{margin-bottom:14px;}
.fg label{display:block;font-size:13px;color:var(--muted);margin-bottom:5px;font-weight:500;}
.fg input,.fg select,.fg textarea{width:100%;background:var(--card);border:1px solid var(--border);border-radius:10px;padding:11px 14px;color:var(--text);font-size:14px;font-family:'DM Sans',sans-serif;outline:none;transition:border-color .2s;}
.fg input:focus,.fg select:focus,.fg textarea:focus{border-color:var(--gold);}
.fg textarea{min-height:80px;resize:vertical;}
.fg select option{background:var(--card);}
.row2{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
.btn-gold{background:var(--gold);color:#000;font-weight:700;font-size:14px;border:none;padding:12px 24px;border-radius:10px;cursor:pointer;transition:background .2s;font-family:'DM Sans',sans-serif;}
.btn-gold:hover{background:var(--gold2);}
.btn-danger{background:transparent;border:1px solid rgba(230,57,70,.4);color:var(--red);font-size:12px;padding:6px 12px;border-radius:7px;cursor:pointer;transition:all .2s;}
.btn-danger:hover{background:rgba(230,57,70,.1);}
.btn-sm{background:transparent;border:1px solid var(--border);color:var(--muted);font-size:12px;padding:6px 12px;border-radius:7px;cursor:pointer;transition:all .2s;}
.btn-sm:hover{border-color:var(--gold);color:var(--gold);}
.file-drop{border:2px dashed rgba(245,166,35,.28);border-radius:12px;padding:24px;text-align:center;cursor:pointer;transition:all .2s;background:rgba(245,166,35,.02);margin-bottom:8px;}
.file-drop:hover{border-color:var(--gold);background:rgba(245,166,35,.05);}
.file-drop i{font-size:32px;color:rgba(245,166,35,.4);margin-bottom:8px;display:block;}
.file-drop p{font-size:13px;color:var(--muted);}
.file-drop span{color:var(--gold);}
.fsel{font-size:12px;color:var(--green);margin-top:4px;}
.success-bar{background:rgba(46,194,126,.1);border:1px solid rgba(46,194,126,.3);color:var(--green);padding:11px 14px;border-radius:9px;font-size:13px;text-align:center;margin-top:12px;}
.err-bar{background:rgba(230,57,70,.1);border:1px solid rgba(230,57,70,.3);color:var(--red);padding:11px 14px;border-radius:9px;font-size:13px;text-align:center;margin-top:12px;}
.msg-card{background:var(--card);border-radius:12px;border:1px solid var(--border);padding:16px;margin-bottom:12px;}
.mch{display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;}
.mname{font-weight:600;font-size:14px;}
.mtime{font-size:11px;color:var(--muted);}
.mtext{font-size:13px;color:var(--muted);line-height:1.6;}
.mcontact{font-size:12px;color:var(--blue);margin-top:5px;}
.unread-dot{width:8px;height:8px;background:var(--gold);border-radius:50%;display:inline-block;margin-right:6px;}
.pwd-note{font-size:12px;color:var(--muted);margin-top:5px;}
</style>
</head>
<body>
<div class="topbar">
  <div class="tlogo">FREEWATCH <span>Admin</span></div>
  <div class="tactions">
    <a href="../index.php" target="_blank"><i class="fa fa-external-link-alt"></i> View Site</a>
    <form method="POST" action="logout.php" style="display:inline">
      <button class="btn-logout" type="submit"><i class="fa fa-sign-out-alt"></i> Logout</button>
    </form>
  </div>
</div>
<div class="nav-tabs">
  <a class="ntab <?= $tab === 'dashboard' ? 'active' : '' ?>" href="?tab=dashboard" id="t-dashboard"><i class="fa fa-chart-bar"></i> Dashboard</a>
  <a class="ntab <?= $tab === 'upload' ? 'active' : '' ?>" href="?tab=upload" id="t-upload"><i class="fa fa-upload"></i> Upload Movie</a>
  <a class="ntab <?= $tab === 'movies' ? 'active' : '' ?>" href="?tab=movies" id="t-movies"><i class="fa fa-film"></i> Manage Movies</a>
  <a class="ntab <?= $tab === 'messages' ? 'active' : '' ?>" href="?tab=messages" id="t-messages"><i class="fa fa-envelope"></i> Messages <?php if ($unreadMsgs > 0): ?><span class="badge-count"><?= $unreadMsgs ?></span><?php endif; ?></a>
  <a class="ntab <?= $tab === 'settings' ? 'active' : '' ?>" href="?tab=settings" id="t-settings"><i class="fa fa-cog"></i> Settings</a>
</div>
<div class="panel <?= $tab === 'dashboard' ? 'active' : '' ?>" id="panel-dashboard">
  <div class="stats-grid">
    <div class="scard"><div class="si">🎬</div><div class="sv"><?= $totalMovies ?></div><div class="sl">Total Movies</div></div>
    <div class="scard"><div class="si">👁</div><div class="sv"><?= format_views((int) $totalViews) ?></div><div class="sl">Total Views</div></div>
    <div class="scard"><div class="si">✉️</div><div class="sv"><?= $totalMsgs ?></div><div class="sl">Messages</div></div>
    <div class="scard"><div class="si">🔴</div><div class="sv"><?= $unreadMsgs ?></div><div class="sl">Unread Messages</div></div>
  </div>
  <div class="tbox">
    <div class="tbox-title">TOP MOVIES BY VIEWS</div>
    <?php $maxV = $topMovies ? max(array_column($topMovies, 'views')) : 1; if ($maxV < 1) $maxV = 1; ?>
    <table>
      <thead><tr><th>#</th><th>Title</th><th>Genre</th><th>Views</th></tr></thead>
      <tbody>
        <?php if (empty($topMovies)): ?>
          <tr class="empty-row"><td colspan="4">No movies yet</td></tr>
        <?php else: foreach ($topMovies as $i => $movie): ?>
          <tr>
            <td style="color:var(--muted);font-weight:700"><?= $i + 1 ?></td>
            <td style="font-weight:500;max-width:130px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?= e($movie['title']) ?></td>
            <td><span class="gtag"><?= e($movie['genre']) ?></span></td>
            <td>
              <strong style="color:var(--gold)"><?= format_views((int) $movie['views']) ?></strong>
              <div class="vbar-wrap"><div class="vbar" style="width:<?= round($movie['views'] / $maxV * 100) ?>%"></div></div>
            </td>
          </tr>
        <?php endforeach; endif; ?>
      </tbody>
    </table>
  </div>
  <?php if (!empty($genreStats)): ?>
  <div class="tbox">
    <div class="tbox-title">VIEWS BY GENRE</div>
    <table>
      <thead><tr><th>Genre</th><th>Movies</th><th>Total Views</th></tr></thead>
      <tbody>
        <?php foreach ($genreStats as $stat): ?>
          <tr>
            <td><span class="gtag"><?= e($stat['genre']) ?></span></td>
            <td style="color:var(--muted)"><?= $stat['cnt'] ?></td>
            <td><strong style="color:var(--gold)"><?= format_views((int) $stat['views']) ?></strong></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <?php endif; ?>
</div>
<div class="panel <?= $tab === 'upload' ? 'active' : '' ?>" id="panel-upload">
  <div class="ubox">
    <h2>UPLOAD NEW MOVIE</h2>
    <?php if ($uploadMessage): ?><div class="success-bar"><?= e($uploadMessage) ?></div><?php endif; ?>
    <?php if ($uploadError): ?><div class="err-bar"><?= e($uploadError) ?></div><?php endif; ?>
    <form method="POST" enctype="multipart/form-data" style="margin-top:<?= ($uploadMessage || $uploadError) ? '16px' : '0' ?>">
      <div class="fg">
        <label>Movie Title *</label>
        <input type="text" name="title" placeholder="Enter full movie title" required>
      </div>
      <div class="row2">
        <div class="fg">
          <label>Genre *</label>
          <select name="genre">
            <?php foreach (['Action','Drama','Comedy','Horror','Thriller','Romance','Animation','Documentary','Sci-Fi','Crime','Adventure','Fantasy','Biography'] as $genreOption): ?>
              <option value="<?= e($genreOption) ?>"><?= e($genreOption) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="fg">
          <label>Year</label>
          <input type="number" name="year" placeholder="<?= date('Y') ?>" min="1900" max="<?= date('Y') + 2 ?>">
        </div>
      </div>
      <div class="fg">
        <label>Duration (e.g. 1h 45m)</label>
        <input type="text" name="duration" placeholder="2h 10m">
      </div>
      <div class="fg">
        <label>Description</label>
        <textarea name="description" placeholder="Brief movie description..."></textarea>
      </div>
      <div class="fg">
        <label>Thumbnail Image (JPG, PNG, WebP)</label>
        <div class="file-drop" onclick="document.getElementById('thFile').click()">
          <i class="fa fa-image"></i>
          <p>Tap to select poster image or <span>browse</span></p>
          <div class="fsel" id="thName">No image selected</div>
        </div>
        <input type="file" id="thFile" name="thumbnail" accept="image/*" style="display:none" onchange="document.getElementById('thName').textContent=this.files[0]?.name || 'No image selected'">
      </div>
      <div class="fg">
        <label>Video File (MP4, WebM, MKV — max 500MB)</label>
        <div class="file-drop" onclick="document.getElementById('vFile').click()">
          <i class="fa fa-film"></i>
          <p>Tap to select video file or <span>browse</span></p>
          <div class="fsel" id="vFileName">No file selected</div>
        </div>
        <input type="file" id="vFile" name="video_file" accept="video/*" style="display:none" onchange="document.getElementById('vFileName').textContent=this.files[0]?.name || 'No file selected'">
      </div>
      <div class="fg" style="display:flex;align-items:center;gap:10px">
        <input type="checkbox" name="featured" id="isFeatured" style="width:auto">
        <label for="isFeatured" style="margin:0;cursor:pointer">Set as Featured (shown in hero)</label>
      </div>
      <button class="btn-gold" type="submit" name="upload_submit"><i class="fa fa-upload"></i> Upload Movie</button>
    </form>
  </div>
</div>
<div class="panel <?= $tab === 'movies' ? 'active' : '' ?>" id="panel-movies">
  <div class="tbox">
    <div class="tbox-title">ALL MOVIES (<?= count($allMovies) ?>)</div>
    <div style="overflow-x:auto">
      <table>
        <thead><tr><th>Title</th><th>Genre</th><th>Year</th><th>Views</th><th>Featured</th><th>Added</th><th>Actions</th></tr></thead>
        <tbody>
          <?php if (empty($allMovies)): ?>
            <tr class="empty-row"><td colspan="7">No movies yet. Upload your first movie!</td></tr>
          <?php else: foreach ($allMovies as $movie): ?>
            <tr>
              <td style="font-weight:500;max-width:130px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?= e($movie['title']) ?></td>
              <td><span class="gtag"><?= e($movie['genre']) ?></span></td>
              <td style="color:var(--muted)"><?= $movie['year'] ?: '--' ?></td>
              <td><strong style="color:var(--gold)"><?= format_views((int) $movie['views']) ?></strong></td>
              <td><?= $movie['featured'] ? '<span style="color:var(--gold)">⭐ Yes</span>' : '<span style="color:var(--muted)">No</span>' ?></td>
              <td style="color:var(--muted);font-size:12px"><?= time_ago($movie['created_at']) ?></td>
              <td>
                <div style="display:flex;gap:6px;flex-wrap:wrap">
                  <?php if (!$movie['featured']): ?>
                    <a href="?tab=movies&toggle_featured=<?= $movie['id'] ?>" class="btn-sm" title="Set as Featured">⭐</a>
                  <?php endif; ?>
                  <a href="?tab=movies&delete=<?= $movie['id'] ?>" class="btn-danger" onclick="return confirm('Delete this movie?')">Delete</a>
                </div>
              </td>
            </tr>
          <?php endforeach; endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="panel <?= $tab === 'messages' ? 'active' : '' ?>" id="panel-messages">
  <div class="ubox">
    <h2>SEND WHATSAPP ANNOUNCEMENT</h2>
    <div class="fg">
      <label>Announcement Title</label>
      <input type="text" id="annTitle" placeholder="New movie added!">
    </div>
    <div class="fg">
      <label>Message Body</label>
      <textarea id="annBody" placeholder="Type your announcement..."></textarea>
    </div>
    <button class="btn-gold" onclick="sendAnn()"><i class="fab fa-whatsapp"></i> Send via WhatsApp</button>
  </div>
  <div class="tbox">
    <div class="tbox-title">VIEWER MESSAGES (<?= count($messages) ?>)</div>
    <?php if (empty($messages)): ?>
      <p style="color:var(--muted);font-size:14px;padding:10px 0">No messages yet.</p>
    <?php else: foreach ($messages as $msg): ?>
      <div class="msg-card">
        <div class="mch">
          <div class="mname">
            <?php if (!$msg['is_read']): ?><span class="unread-dot"></span><?php endif; ?>
            <?= e($msg['name']) ?>
          </div>
          <div style="display:flex;align-items:center;gap:8px">
            <span class="mtime"><?= time_ago($msg['created_at']) ?></span>
            <a href="?tab=messages&del_msg=<?= $msg['id'] ?>" class="btn-danger" onclick="return confirm('Delete message?')" style="font-size:11px">Delete</a>
          </div>
        </div>
        <div class="mtext"><?= e($msg['message']) ?></div>
        <?php if ($msg['contact']): ?>
          <div class="mcontact"><i class="fa fa-phone"></i> <?= e($msg['contact']) ?>
            <a href="https://wa.me/<?= \App\Helper::normalizePhone($msg['contact']) ?>?text=Hi%20<?= rawurlencode($msg['name']) ?>!" target="_blank" style="color:var(--green);margin-left:8px"><i class="fab fa-whatsapp"></i> Reply</a>
          </div>
        <?php endif; ?>
      </div>
    <?php endforeach; endif; ?>
  </div>
</div>
<div class="panel <?= $tab === 'settings' ? 'active' : '' ?>" id="panel-settings">
  <div class="ubox">
    <h2>SITE SETTINGS</h2>
    <?php if ($settingsMessage): ?><div class="success-bar" style="margin-bottom:16px"><?= e($settingsMessage) ?></div><?php endif; ?>
    <?php if ($settingsError): ?><div class="err-bar" style="margin-bottom:16px"><?= e($settingsError) ?></div><?php endif; ?>
    <form method="POST">
      <div class="fg">
        <label>WhatsApp Number (with country code, no +)</label>
        <input type="text" name="wa_number" value="<?= e($waNumber) ?>" placeholder="255712345678">
      </div>
      <div class="fg">
        <label>Channel / Website URL</label>
        <input type="text" name="channel_url" value="<?= e($channelUrl) ?>" placeholder="https://pauloflix.com">
      </div>
      <div class="fg">
        <label>Site Description</label>
        <input type="text" name="site_desc" value="<?= e($siteDesc) ?>" placeholder="Watch free movies online">
      </div>
      <hr style="border-color:var(--border);margin:20px 0">
      <h2 style="font-size:16px;margin-bottom:16px;color:var(--muted)">CHANGE ADMIN CREDENTIALS</h2>
      <div class="fg">
        <label>New Username</label>
        <input type="text" name="new_username" value="<?= e($adminUser) ?>" placeholder="admin">
      </div>
      <div class="fg">
        <label>New Password <span class="pwd-note">(leave blank to keep current)</span></label>
        <input type="password" name="new_password" placeholder="New password">
      </div>
      <div class="fg">
        <label>Confirm New Password</label>
        <input type="password" name="confirm_password" placeholder="Repeat new password">
      </div>
      <button class="btn-gold" type="submit" name="settings_submit"><i class="fa fa-save"></i> Save Settings</button>
    </form>
  </div>
</div>
<script>
(function() {
  const tab = new URLSearchParams(location.search).get('tab') || 'dashboard';
  document.querySelectorAll('.ntab').forEach(t => t.classList.remove('active'));
  document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
  const el = document.getElementById('t-' + tab);
  const pan = document.getElementById('panel-' + tab);
  if (el) el.classList.add('active');
  if (pan) pan.classList.add('active');
})();
function sendAnn() {
  const title = document.getElementById('annTitle').value.trim();
  const body = document.getElementById('annBody').value.trim();
  if (!body) {
    alert('Please enter a message.');
    return;
  }
  const text = encodeURIComponent((title ? '🎬 *' + title + '*\n\n' : '') + body + '\n\n📺 Watch on FreeWatch: <?= e($channelUrl) ?>');
  window.open('https://wa.me/<?= e($waNumber) ?>?text=' + text, '_blank');
}
</script>
</body>
</html>
