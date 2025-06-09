<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="song">
    <title>Ma Playlist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body class="bg-light text-dark">

<div class="container py-5">
    <h1 class="text-center mb-5 text-primary fw-bold"><i class="ri-music-2-fill"></i> Liste des chansons</h1>

    <div class="row g-4 justify-content-center">
        <?php foreach ($chansons as $chanson) : ?>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm" data-chanson="<?= $chanson['id_chanson']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($chanson['titre']); ?></h5>
                        <p class="card-text"><strong>Année :</strong> <?= htmlspecialchars($chanson['annee']); ?></p>
                        <p class="card-text"><strong>Chanteur :</strong> <?= htmlspecialchars($chanson['nom_chanteur']); ?></p>
                        <p class="card-text"><strong>Catégorie :</strong> <?= htmlspecialchars($chanson['libelle_categorie']); ?></p>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="/deleteSong/<?= $chanson['id_chanson']; ?>" class="delete-song btn btn-outline-danger btn-sm">
                            <i class="ri-delete-bin-6-line"></i> Supprimer
                        </a>
                        <a href="/updateSong/<?= $chanson['id_chanson']; ?>" class="btn btn-outline-primary btn-sm">
                            <i class="ri-edit-2-line"></i> Modifier
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <h2 class="text-center mt-5 text-dark">Ajouter une chanson</h2>

    <form method="POST" id="addForm" class="bg-white p-4 rounded shadow-sm mx-auto mt-4" style="max-width: 600px;">
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" class="form-control" id="titre" name="titre">
            <div class="form-text text-danger error-titre"></div>
        </div>

        <div class="mb-3">
            <label for="annee" class="form-label">Année</label>
            <input type="text" class="form-control" id="annee" name="annee">
            <div class="form-text text-danger error-annee"></div>
        </div>

        <div class="mb-3">
            <label for="chanteur" class="form-label">Chanteur</label>
            <select class="form-select" id="chanteur" name="chanteur">
                <?php foreach ($chanteurs as $chanteur): ?>
                    <option value="<?= $chanteur["id_chanteur"]; ?>" data-chanteur="<?= $chanteur["nom_chanteur"]; ?>">
                        <?= $chanteur["nom_chanteur"]; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-4">
            <label for="categorie" class="form-label">Catégorie</label>
            <select class="form-select" id="categorie" name="categorie">
                <?php foreach ($categories as $categorie): ?>
                    <option value="<?= $categorie["id_categorie"]; ?>" data-categorie="<?= $categorie["libelle_categorie"]; ?>">
                        <?= $categorie["libelle_categorie"]; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-dark w-100">Ajouter la chanson</button>
        <p class="text-success mt-3 text-center success"></p>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/addSong.js"></script>
</body>
</html>
