<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Modifier la chanson</title>
    <meta name="description" content="Formulaire de modification">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #f0f4f8, #ffffff);
            min-height: 100vh;
        }

        h1 {
            font-size: 2.2rem;
        }

        form {
            transition: box-shadow 0.3s ease;
        }

        form:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .form-label {
            font-weight: 600;
            color: #2c3e50;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            font-size: 1rem;
        }

        .btn-success {
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
        }

        .btn-success i {
            margin-right: 6px;
        }

        .error-titre,
        .error-annee {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: 4px;
        }

        .success {
            color: #28a745;
            text-align: center;
            margin-top: 20px;
            font-weight: 500;
        }
    </style>
</head>

<body>

<div class="container py-5">
    <h1 class="text-center text-primary fw-bold mb-4">
        <i class="ri-edit-2-line"></i> Modifier une chanson
    </h1>

    <form method="POST" class="bg-white p-4 rounded shadow-sm mx-auto" style="max-width: 600px;" data-id="<?= $chanson["id_chanson"]; ?>">
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" id="titre" name="titre" value="<?= htmlspecialchars($chanson['titre']); ?>" class="form-control">
            <p class="error-titre"></p>
        </div>

        <div class="mb-3">
            <label for="annee" class="form-label">Année</label>
            <input type="text" id="annee" name="annee" value="<?= htmlspecialchars($chanson['annee']); ?>" class="form-control">
            <p class="error-annee"></p>
        </div>

        <div class="mb-3">
            <label for="chanteur" class="form-label">Chanteur</label>
            <select name="chanteur" id="chanteur" class="form-select">
                <?php foreach ($chanteurs as $ch) : ?>
                    <option value="<?= $ch['id_chanteur']; ?>" <?= $ch['id_chanteur'] == $chanson['id_chanteur'] ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($ch['nom_chanteur']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-4">
            <label for="categorie" class="form-label">Catégorie</label>
            <select name="categorie" id="categorie" class="form-select">
                <?php foreach ($categories as $cat) : ?>
                    <option value="<?= $cat['id_categorie']; ?>" <?= $cat['id_categorie'] == $chanson['id_categorie'] ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($cat['libelle_categorie']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-success">
                <i class="ri-save-line"></i> Enregistrer les modifications
            </button>
        </div>
        <p class="success"></p>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/updateSong.js"></script>
</body>

</html>
