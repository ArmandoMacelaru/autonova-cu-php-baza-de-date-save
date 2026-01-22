<?php
include 'header.php';
require_once __DIR__ . '/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = (int)$_SESSION['user_id'];
$username = $_SESSION['username'] ?? 'Utilizator';

$tab = $_GET['tab'] ?? 'vizionate';
$tab = in_array($tab, ['vizionate','mele'], true) ? $tab : 'vizionate';

// === Mașini vizionate ===
$vizionate = [];
if ($stmt = $conn->prepare("
    SELECT m.id, m.marca, m.model, m.pret, m.imagine, v.viewed_at
    FROM vizualizari v
    JOIN masini m ON m.id = v.masina_id
    WHERE v.user_id = ?
    ORDER BY v.viewed_at DESC
    LIMIT 30
")) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $vizionate = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

// === Mașinile mele ===
$mele = [];
if ($stmt = $conn->prepare("
    SELECT id, marca, model, pret, imagine, data_adaugare
    FROM masini
    WHERE user_id = ?
    ORDER BY id DESC
    LIMIT 50
")) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $mele = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profil - AutoNova</title>
  <link rel="stylesheet" href="css/styles.css">
  <style>
    .wrap{max-width:1200px;margin:30px auto;padding:0 20px;}
    .card{background:var(--bg-secondary,#fff);border:1px solid var(--border-color,#e0e0e0);border-radius:12px;padding:18px;box-shadow:0 2px 12px rgba(0,0,0,.06);}
    .tabs{display:flex;gap:10px;flex-wrap:wrap;margin:14px 0 18px;}
    .tab{padding:10px 14px;border-radius:10px;border:1px solid var(--border-color,#e0e0e0);text-decoration:none;font-weight:800;color:var(--text-primary,#333);background:var(--bg-secondary,#fff);}
    .tab.active{background:var(--accent-color,#ff6a00);border-color:var(--accent-color,#ff6a00);color:#fff;}
    .grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:14px;margin-top:14px;}
    .item{border:1px solid var(--border-color,#e0e0e0);border-radius:12px;overflow:hidden;background:var(--bg-secondary,#fff);}
    .item img{width:100%;height:150px;object-fit:cover;display:block;}
    .item .p{padding:12px;}
    .item .t{font-weight:900;}
    .item .price{color:var(--accent-color,#ff6a00);font-weight:900;margin-top:6px;}
    .item a{display:inline-block;margin-top:10px;text-decoration:none;font-weight:800;color:var(--accent-color,#ff6a00);}
    .muted{color:var(--text-secondary,#666);}
    .meta{font-size:13px;color:var(--text-muted,#999);margin-top:6px;}
  </style>
</head>
<body>
  <div class="wrap">
    <div class="card">
      <h2>Profil: <?php echo htmlspecialchars($username); ?></h2>
      <p class="muted">Aici vezi istoricul mașinilor vizionate și mașinile adăugate de tine.</p>

      <div class="tabs">
        <a class="tab <?php echo $tab==='vizionate'?'active':''; ?>" href="profil.php?tab=vizionate">Mașini vizionate</a>
        <a class="tab <?php echo $tab==='mele'?'active':''; ?>" href="profil.php?tab=mele">Mașinile mele</a>
      </div>

      <?php if ($tab === 'vizionate'): ?>
        <?php if (empty($vizionate)): ?>
          <p class="muted">Încă nu ai vizionat nicio mașină.</p>
        <?php else: ?>
          <div class="grid">
            <?php foreach ($vizionate as $m): ?>
              <div class="item">
                <img src="<?php echo htmlspecialchars($m['imagine'] ?? ''); ?>" alt="">
                <div class="p">
                  <div class="t"><?php echo htmlspecialchars(($m['marca']??'').' '.($m['model']??'')); ?></div>
                  <div class="price"><?php echo number_format((float)($m['pret']??0),0,',','.'); ?> €</div>
                  <div class="meta">Văzut: <?php echo htmlspecialchars($m['viewed_at'] ?? ''); ?></div>
                  <a href="detalii.php?id=<?php echo (int)$m['id']; ?>">Vezi detalii →</a>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      <?php else: ?>
        <?php if (empty($mele)): ?>
          <p class="muted">Nu ai adăugat încă nicio mașină.</p>
        <?php else: ?>
          <div class="grid">
            <?php foreach ($mele as $m): ?>
              <div class="item">
                <img src="<?php echo htmlspecialchars($m['imagine'] ?? ''); ?>" alt="">
                <div class="p">
                  <div class="t"><?php echo htmlspecialchars(($m['marca']??'').' '.($m['model']??'')); ?></div>
                  <div class="price"><?php echo number_format((float)($m['pret']??0),0,',','.'); ?> €</div>
                  <div class="meta">Adăugată: <?php echo htmlspecialchars($m['data_adaugare'] ?? ''); ?></div>
                  <a href="detalii.php?id=<?php echo (int)$m['id']; ?>">Vezi detalii →</a>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      <?php endif; ?>

    </div>
  </div>
</body>
</html>
