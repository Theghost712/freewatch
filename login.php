<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login — FreeWatch</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root{--bg:#080c14;--surface:#0f1724;--card:#141e2e;--border:rgba(255,255,255,0.07);--gold:#f5a623;--gold2:#ffcc66;--text:#e8eaf0;--muted:#7a8499;--red:#e63946;}
*{margin:0;padding:0;box-sizing:border-box;}
body{background:var(--bg);color:var(--text);font-family:'DM Sans',sans-serif;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px;}
.box{background:var(--surface);border-radius:18px;border:1px solid var(--border);padding:36px 28px;width:100%;max-width:360px;}
.logo{font-family:'Bebas Neue',sans-serif;font-size:30px;color:var(--gold);text-align:center;letter-spacing:3px;margin-bottom:4px;}
.sub{text-align:center;font-size:13px;color:var(--muted);margin-bottom:28px;}
.fg{margin-bottom:16px;}
.fg label{display:block;font-size:13px;color:var(--muted);margin-bottom:5px;font-weight:500;}
.fg input{width:100%;background:var(--card);border:1px solid var(--border);border-radius:10px;padding:12px 14px;color:var(--text);font-size:14px;font-family:'DM Sans',sans-serif;outline:none;transition:border-color .2s;}
.fg input:focus{border-color:var(--gold);}
.btn{width:100%;background:var(--gold);color:#000;font-weight:700;font-size:15px;border:none;padding:13px;border-radius:10px;cursor:pointer;transition:background .2s;font-family:'DM Sans',sans-serif;}
.btn:hover{background:var(--gold2);}
.err{background:rgba(230,57,70,.1);border:1px solid rgba(230,57,70,.3);color:var(--red);padding:10px 14px;border-radius:8px;font-size:13px;text-align:center;margin-top:12px;}
.back{text-align:center;margin-top:18px;}
.back a{color:var(--muted);font-size:13px;text-decoration:none;}
.back a:hover{color:var(--gold);}
</style>
</head>
<body>
<div class="box">
  <div class="logo">FREEWATCH</div>
  <div class="sub">Admin Panel — Restricted Access</div>
  <form method="POST" autocomplete="off">
    <div class="fg">
      <label>Username</label>
      <input type="text" name="username" placeholder="admin" required autofocus>
    </div>
    <div class="fg">
      <label>Password</label>
      <input type="password" name="password" placeholder="••••••••" required>
    </div>
    <button class="btn" type="submit"><i class="fa fa-lock"></i> Login</button>
    <?php if (!empty($error)): ?>
      <div class="err"><?= e($error) ?></div>
    <?php endif; ?>
  </form>
  <div class="back"><a href="../index.php"><i class="fa fa-arrow-left"></i> Back to Site</a></div>
</div>
</body>
</html>
