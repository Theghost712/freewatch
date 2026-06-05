<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FreeWatch — Free Movies Online</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root{--bg:#080c14;--surface:#0f1724;--card:#141e2e;--border:rgba(255,255,255,0.07);--gold:#f5a623;--gold2:#ffcc66;--text:#e8eaf0;--muted:#7a8499;--red:#e63946;--green:#2ec27e;}
*{margin:0;padding:0;box-sizing:border-box;}
body{background:var(--bg);color:var(--text);font-family:'DM Sans',sans-serif;min-height:100vh;overflow-x:hidden;}
nav{position:sticky;top:0;z-index:100;background:rgba(8,12,20,0.94);backdrop-filter:blur(16px);border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;padding:0 20px;height:62px;}
.logo{font-family:'Bebas Neue',sans-serif;font-size:28px;color:var(--gold);letter-spacing:3px;text-decoration:none;}
.logo span{color:var(--text);}
.nav-right{display:flex;gap:8px;align-items:center;}
.nav-right a{color:var(--muted);text-decoration:none;font-size:14px;padding:6px 12px;border-radius:8px;transition:all .2s;}
.nav-right a:hover{color:var(--text);background:rgba(255,255,255,0.05);}
.nav-right .btn-admin{background:var(--gold);color:#000;font-weight:700;padding:7px 16px;border-radius:8px;font-size:13px;}
.nav-right .btn-admin:hover{background:var(--gold2);color:#000;}
.search-wrap{padding:26px 20px 0;max-width:680px;margin:0 auto;}
.search-form{display:flex;background:var(--surface);border:1.5px solid var(--border);border-radius:14px;overflow:hidden;transition:border-color .2s;}
.search-form:focus-within{border-color:var(--gold);}
.search-form input{flex:1;background:transparent;border:none;outline:none;padding:13px 18px;color:var(--text);font-size:15px;font-family:'DM Sans',sans-serif;}
.search-form input::placeholder{color:var(--muted);}
.search-form button{background:var(--gold);border:none;padding:0 22px;color:#000;font-size:16px;cursor:pointer;transition:background .2s;font-family:'DM Sans',sans-serif;font-weight:700;}
.search-form button:hover{background:var(--gold2);}
.pills{display:flex;gap:8px;overflow-x:auto;padding:18px 20px 0;scrollbar-width:none;}
.pills::-webkit-scrollbar{display:none;}
.pill{background:var(--surface);border:1px solid var(--border);color:var(--muted);font-size:13px;padding:7px 16px;border-radius:20px;cursor:pointer;white-space:nowrap;transition:all .2s;flex-shrink:0;text-decoration:none;}
.pill:hover,.pill.active{background:var(--gold);color:#000;border-color:var(--gold);font-weight:600;}
.hero{margin:22px 20px 0;border-radius:18px;overflow:hidden;height:240px;position:relative;background:linear-gradient(135deg,#0f1e3a,#1a0a2e);cursor:pointer;}
.hero-thumb{width:100%;height:100%;object-fit:cover;opacity:.38;display:block;}
.hero-gradient{position:absolute;inset:0;background:linear-gradient(to right,rgba(8,12,20,.97) 28%,rgba(8,12,20,.3));}
.hero-content{position:absolute;bottom:0;left:0;padding:24px;max-width:290px;}
.hero-badge{display:inline-block;background:var(--gold);color:#000;font-size:10px;font-weight:700;padding:3px 10px;border-radius:5px;margin-bottom:8px;letter-spacing:1.5px;}
.hero-title{font-family:'Bebas Neue',sans-serif;font-size:34px;line-height:1.05;color:#fff;margin-bottom:6px;}
.hero-meta{font-size:12px;color:var(--muted);margin-bottom:14px;}
.btn-play{display:inline-flex;align-items:center;gap:8px;background:var(--gold);color:#000;font-weight:700;font-size:14px;border:none;padding:10px 22px;border-radius:10px;cursor:pointer;transition:all .2s;text-decoration:none;}
.btn-play:hover{background:var(--gold2);transform:scale(1.03);}
.no-hero{display:flex;align-items:center;justify-content:center;height:100%;color:var(--muted);font-size:15px;}
.channel-strip{margin:20px 20px 0;background:linear-gradient(90deg,rgba(245,166,35,.1),rgba(245,166,35,.03));border:1px solid rgba(245,166,35,.22);border-radius:14px;padding:14px 18px;display:flex;align-items:center;gap:14px;}
.ch-icon{font-size:24px;color:var(--gold);}
.ch-name{font-weight:700;font-size:14px;color:var(--gold);}
.ch-sub{font-size:12px;color:var(--muted);}
.ch-follow{margin-left:auto;background:var(--gold);color:#000;font-weight:700;font-size:13px;padding:8px 18px;border-radius:9px;text-decoration:none;white-space:nowrap;transition:background .2s;}
.ch-follow:hover{background:var(--gold2);}
section{padding:28px 20px 0;}
.sec-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;}
.sec-title{font-family:'Bebas Neue',sans-serif;font-size:22px;letter-spacing:1px;}
.sec-count{font-size:13px;color:var(--muted);}
.grid{display:grid;grid-template-columns:repeat(2,1fr);gap:14px;}
.movie-card{background:var(--card);border-radius:14px;overflow:hidden;border:1px solid var(--border);cursor:pointer;transition:transform .2s,border-color .2s;position:relative;text-decoration:none;display:block;color:inherit;}
.movie-card:hover{transform:translateY(-4px);border-color:rgba(245,166,35,.35);}
.thumb-wrap{position:relative;width:100%;aspect-ratio:2/3;overflow:hidden;background:#0c1828;}
.thumb-wrap img{width:100%;height:100%;object-fit:cover;}
.thumb-placeholder{width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:44px;background:linear-gradient(145deg,#1a2440,#0c1828);}
.new-badge{position:absolute;top:8px;left:8px;background:var(--red);color:#fff;font-size:10px;font-weight:700;padding:2px 8px;border-radius:5px;letter-spacing:.5px;}
.featured-badge{position:absolute;top:8px;left:8px;background:var(--gold);color:#000;font-size:10px;font-weight:700;padding:2px 8px;border-radius:5px;letter-spacing:.5px;}
.movie-info{padding:10px 12px 12px;}
.movie-title{font-weight:600;font-size:14px;margin-bottom:4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.movie-meta{font-size:12px;color:var(--muted);display:flex;gap:8px;align-items:center;flex-wrap:wrap;}
.gtag{font-size:11px;background:rgba(245,166,35,.12);color:var(--gold);padding:2px 8px;border-radius:5px;font-weight:500;}
.vcount{display:flex;align-items:center;gap:3px;font-size:11px;color:var(--muted);}
.empty-state{grid-column:1/-1;text-align:center;padding:50px 20px;color:var(--muted);}
.empty-state i{font-size:40px;margin-bottom:12px;display:block;color:rgba(245,166,35,.3);}
.search-result-header{padding:10px 20px 0;font-size:14px;color:var(--muted);}
.search-result-header strong{color:var(--text);}
.contact-section{margin:32px 20px 0;}
.contact-box{background:var(--surface);border-radius:16px;border:1px solid var(--border);padding:22px 20px;}
.contact-title{font-family:'Bebas Neue',sans-serif;font-size:20px;color:var(--gold);letter-spacing:1px;margin-bottom:18px;}
.form-group{margin-bottom:14px;}
.form-group label{display:block;font-size:13px;color:var(--muted);margin-bottom:5px;font-weight:500;}
.form-group input,.form-group textarea{width:100%;background:var(--card);border:1px solid var(--border);border-radius:10px;padding:11px 14px;color:var(--text);font-size:14px;font-family:'DM Sans',sans-serif;outline:none;transition:border-color .2s;}
.form-group input:focus,.form-group textarea:focus{border-color:var(--gold);}
.form-group textarea{min-height:80px;resize:vertical;}
.btn-submit{background:var(--gold);color:#000;font-weight:700;font-size:14px;border:none;padding:12px 28px;border-radius:10px;cursor:pointer;transition:background .2s;font-family:'DM Sans',sans-serif;}
.btn-submit:hover{background:var(--gold2);}
.msg-sent{background:rgba(46,194,126,.1);border:1px solid rgba(46,194,126,.3);color:var(--green);padding:12px 16px;border-radius:10px;font-size:14px;text-align:center;margin-top:12px;display:none;}
.msg-error{background:rgba(230,57,70,.1);border:1px solid rgba(230,57,70,.3);color:var(--red);padding:12px 16px;border-radius:10px;font-size:14px;text-align:center;margin-top:12px;display:none;}
.float-btns{position:fixed;bottom:24px;right:18px;display:flex;flex-direction:column;align-items:flex-end;gap:12px;z-index:200;}
.fb-wrap{display:flex;align-items:center;gap:10px;}
.fb-label{font-size:12px;background:rgba(8,12,20,.9);color:var(--text);padding:5px 11px;border-radius:20px;white-space:nowrap;border:1px solid var(--border);opacity:0;transition:opacity .2s;pointer-events:none;}
.fb-wrap:hover .fb-label{opacity:1;}
.fb{width:52px;height:52px;border-radius:50%;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:22px;box-shadow:0 4px 22px rgba(0,0,0,.55);transition:transform .2s;text-decoration:none;}
.fb:hover{transform:scale(1.12);}
.fb-wa{background:#25D366;color:#fff;}
.fb-ch{background:var(--gold);color:#000;font-family:'Bebas Neue',sans-serif;font-size:16px;letter-spacing:1px;}
.modal{display:none;position:fixed;inset:0;background:rgba(5,8,15,.95);z-index:999;overflow-y:auto;padding:16px;}
.modal.open{display:block;}
.modal-close{position:fixed;top:16px;right:16px;background:rgba(255,255,255,.1);border:none;color:#fff;width:42px;height:42px;border-radius:50%;font-size:20px;cursor:pointer;z-index:1001;transition:background .2s;}
.modal-close:hover{background:rgba(255,255,255,.2);}
.modal-box{background:var(--surface);border-radius:18px;max-width:600px;margin:0 auto;overflow:hidden;border:1px solid var(--border);}
.modal-video video{width:100%;display:block;background:#000;max-height:320px;}
.no-video{display:flex;align-items:center;justify-content:center;height:180px;background:#000;color:var(--muted);font-size:14px;flex-direction:column;gap:8px;}
.modal-body{padding:20px;}
.modal-title{font-family:'Bebas Neue',sans-serif;font-size:28px;margin-bottom:8px;}
.modal-badges{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:12px;}
.modal-desc{font-size:14px;color:var(--muted);line-height:1.7;margin-bottom:16px;}
.modal-stats{display:flex;gap:24px;border-top:1px solid var(--border);padding-top:14px;}
.mstat .val{font-size:20px;font-weight:700;color:var(--gold);}
.mstat .lbl{font-size:11px;color:var(--muted);}
footer{margin-top:48px;padding:24px 20px 100px;border-top:1px solid var(--border);text-align:center;color:var(--muted);font-size:12px;line-height:1.9;}
footer a{color:var(--gold);text-decoration:none;}
</style>
</head>
<body>
<nav>
  <a href="index.php" class="logo">FREE<span>WATCH</span></a>
  <div class="nav-right">
    <a href="index.php">Home</a>
    <a href="index.php?genre=">Movies</a>
    <a href="admin/login.php" class="btn-admin"><i class="fa fa-lock"></i> Admin</a>
  </div>
</nav>
<div class="search-wrap">
  <form class="search-form" method="GET" action="index.php">
    <input type="text" name="q" placeholder="Search movies, genres..." value="<?= e($search) ?>" autocomplete="off">
    <button type="submit"><i class="fa fa-search"></i></button>
  </form>
</div>
<div class="pills">
  <a href="index.php" class="pill <?= $genre === '' && !$search ? 'active' : '' ?>">All</a>
  <?php foreach ($genres as $g): ?>
    <a href="index.php?genre=<?= urlencode($g) ?>" class="pill <?= $genre === $g ? 'active' : '' ?>"><?= e($g) ?></a>
  <?php endforeach; ?>
</div>
<?php if ($search): ?>
<div class="search-result-header">
  Results for <strong>"<?= e($search) ?>"</strong> — <?= count($movies) ?> found
  <a href="index.php" style="color:var(--muted);margin-left:8px;font-size:12px;">clear</a>
</div>
<?php endif; ?>
<?php if (!$search && !$genre): ?>
<div class="hero" onclick="<?= $featured ? 'openMovie(' . $featured['id'] . ')' : '' ?>">
  <?php if ($featured && $featured['thumbnail']): ?>
    <img class="hero-thumb" src="uploads/thumbnails/<?= e($featured['thumbnail']) ?>" alt="">
  <?php endif; ?>
  <div class="hero-gradient"></div>
  <div class="hero-content">
    <?php if ($featured): ?>
      <div class="hero-badge">FEATURED</div>
      <div class="hero-title"><?= e($featured['title']) ?></div>
      <div class="hero-meta"><?= e($featured['genre']) ?> <?= $featured['year'] ? '· ' . $featured['year'] : '' ?> · <?= format_views((int) $featured['views']) ?> views</div>
      <button class="btn-play" onclick="openMovie(<?= $featured['id'] ?>)"><i class="fa fa-play"></i> Watch Now</button>
    <?php else: ?>
      <div class="no-hero">No movies yet — add some via Admin panel</div>
    <?php endif; ?>
  </div>
</div>
<div class="channel-strip">
  <i class="fa fa-tv ch-icon"></i>
  <div>
    <div class="ch-name">FreeWatch Official Channel</div>
    <div class="ch-sub"><?= e($channelUrl) ?> — New movies daily</div>
  </div>
  <a href="<?= e($channelUrl) ?>" target="_blank" class="ch-follow">Follow</a>
</div>
<?php endif; ?>
<section>
  <div class="sec-head">
    <div class="sec-title"><?php if ($search) echo 'Search Results'; elseif ($genre) echo e($genre); else echo 'All Movies'; ?></div>
    <div class="sec-count"><?= count($movies) ?> movies</div>
  </div>
  <div class="grid" id="movieGrid">
    <?php if (empty($movies)): ?>
      <div class="empty-state">
        <i class="fa fa-film"></i>
        <?= $search ? 'No movies found for "' . e($search) . '"' : 'No movies available yet.' ?>
      </div>
    <?php else: foreach ($movies as $i => $m): ?>
      <a class="movie-card" href="javascript:void(0)" onclick="openMovie(<?= $m['id'] ?>)">
        <div class="thumb-wrap">
          <?php if ($m['thumbnail']): ?>
            <img src="uploads/thumbnails/<?= e($m['thumbnail']) ?>" alt="<?= e($m['title']) ?>" loading="lazy">
          <?php else: ?>
            <div class="thumb-placeholder">🎬</div>
          <?php endif; ?>
          <?php if ($i < 3): ?>
            <div class="new-badge">NEW</div>
          <?php elseif ($m['featured']): ?>
            <div class="featured-badge">⭐ FEATURED</div>
          <?php endif; ?>
        </div>
        <div class="movie-info">
          <div class="movie-title"><?= e($m['title']) ?></div>
          <div class="movie-meta">
            <span class="gtag"><?= e($m['genre']) ?></span>
            <span class="vcount"><i class="fa fa-eye"></i> <?= format_views((int) $m['views']) ?></span>
          </div>
        </div>
      </a>
    <?php endforeach; endif; ?>
  </div>
</section>
<div class="contact-section">
  <div class="contact-box">
    <div class="contact-title">SEND US A MESSAGE</div>
    <?php if ($contactStatus): ?>
      <div class="msg-sent" style="display:block"><?= e($contactStatus) ?></div>
    <?php endif; ?>
    <?php if ($contactError): ?>
      <div class="msg-error" style="display:block"><?= e($contactError) ?></div>
    <?php endif; ?>
    <form method="POST">
      <div class="form-group">
        <label>Your Name</label>
        <input type="text" name="msg_name" placeholder="Your name" required>
      </div>
      <div class="form-group">
        <label>Phone / WhatsApp (optional)</label>
        <input type="text" name="msg_contact" placeholder="+255 7XX XXX XXX">
      </div>
      <div class="form-group">
        <label>Message</label>
        <textarea name="msg_message" placeholder="Request a movie, report an issue..." required></textarea>
      </div>
      <button class="btn-submit" type="submit" name="msg_submit">Send Message</button>
    </form>
  </div>
</div>
<div class="float-btns">
  <div class="fb-wrap">
    <span class="fb-label">Chat on WhatsApp</span>
    <a href="https://wa.me/<?= e($waNumber) ?>?text=Hi%20FreeWatch!" target="_blank" class="fb fb-wa"><i class="fab fa-whatsapp"></i></a>
  </div>
  <div class="fb-wrap">
    <span class="fb-label">FreeWatch Channel</span>
    <a href="<?= e($channelUrl) ?>" target="_blank" class="fb fb-ch">FW</a>
  </div>
</div>
<footer>
  <strong style="color:var(--gold);font-family:'Bebas Neue',sans-serif;font-size:18px;letter-spacing:2px;">FREEWATCH</strong><br>
  Stream free movies online · New content daily<br>
  <a href="<?= e($channelUrl) ?>" target="_blank"><?= e($channelUrl) ?></a><br>
  <span style="font-size:11px;">© <?= date('Y') ?> FreeWatch. All rights reserved.</span>
</footer>
<div class="modal" id="playerModal">
  <button class="modal-close" onclick="closeModal()"><i class="fa fa-times"></i></button>
  <div class="modal-box">
    <div class="modal-video" id="videoArea"></div>
    <div class="modal-body">
      <div class="modal-title" id="mTitle"></div>
      <div class="modal-badges" id="mBadges"></div>
      <div class="modal-desc" id="mDesc"></div>
      <div class="modal-stats">
        <div class="mstat"><div class="val" id="mViews">0</div><div class="lbl">Views</div></div>
        <div class="mstat"><div class="val" id="mYear">--</div><div class="lbl">Year</div></div>
        <div class="mstat"><div class="val" id="mDur">--</div><div class="lbl">Duration</div></div>
      </div>
    </div>
  </div>
</div>
<script>
const MOVIES = <?= json_encode($movies, JSON_HEX_TAG) ?>;
function openMovie(id) {
    const movie = MOVIES.find(item => item.id == id);
    if (!movie) return;
    fetch('api/view.php?id=' + id);
    document.getElementById('mTitle').textContent = movie.title;
    document.getElementById('mDesc').textContent = movie.description || 'No description.';
    document.getElementById('mViews').textContent = (parseInt(movie.views, 10) || 0) + 1;
    document.getElementById('mYear').textContent = movie.year || '--';
    document.getElementById('mDur').textContent = movie.duration || '--';
    const badges = document.getElementById('mBadges');
    badges.innerHTML = `<span class="gtag">${movie.genre}</span>${movie.year ? `<span class="gtag" style="background:rgba(255,255,255,.07);color:var(--text)">${movie.year}</span>` : ''}`;
    const videoArea = document.getElementById('videoArea');
    if (movie.video_file) {
        videoArea.innerHTML = `<video controls controlsList="nodownload" autoplay style="width:100%;display:block;background:#000;max-height:320px"><source src="uploads/movies/${movie.video_file}"><p style="color:#fff;padding:14px">Your browser does not support video playback.</p></video>`;
    } else {
        videoArea.innerHTML = `<div class="no-video"><i class="fa fa-video-slash" style="font-size:32px;color:var(--muted)"></i><span>Video not available yet</span></div>`;
    }
    document.getElementById('playerModal').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeModal() {
    document.getElementById('playerModal').classList.remove('open');
    document.getElementById('videoArea').innerHTML = '';
    document.body.style.overflow = '';
}
</script>
</body>
</html>
