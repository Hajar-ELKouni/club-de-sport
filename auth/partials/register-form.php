<div class="input-group mb-3">
    <span for="" class="input-group-text">Nom Complete</span>
    <input type="text" name="first_name" placeholder="Nom" class="form-control" id="first_name" value="<?= $oldNom ?>" maxlength="200" required aria-label="first-name" />
    <input type="text" name="last_name" placeholder="Prenom" class="form-control" id="last_name" value="<?= $oldPrenom ?>" maxlength="200" required aria-label="last-name" />
</div>

<div class="form-group mb-3 w-50">
    <label for="date_naissance" class="form-label">Date de Naissance</label>
    <input type="date" name="date_naissance" class="form-control" id="date_naissance" value="<?= $oldDateNaissance ?>" required />
</div>

<div class="form-group d-flex gap-3 mb-3">
    <label for="gender" class="form-label">Genre:</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="gender" id="homme" value="homme" <?= (isset($_POST['gender']) && $_POST['gender'] == 'homme') ? 'checked' : ''; ?> checked required />
        <label class="form-check-label" for="homme">
            Homme
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="gender" id="femme" value="femme" <?= (isset($_POST['gender']) && $_POST['gender'] == 'femme') ? 'checked' : ''; ?> required />
        <label class="form-check-label" for="femme">
            Femme
        </label>
    </div>
</div>

<div class="form-group mb-3">
    <label for="inputEmail1" class="form-label">Email address</label>
    <input type="email" name="email" placeholder="Email address" class="form-control" id="inputEmail1" aria-describedby="emailHelp" value="<?= $oldEmail ?>" maxlength="200" required />
</div>
<div class="form-group mb-3">
    <label for="inputPassword" class="form-label">Mot de passe</label>
    <input type="password" name="password" maxlength="255" placeholder="Mot de passe" class="form-control" id="inputPassword" required />
</div>
<div class="form-group mb-3">
    <label for="password_confirmation" class="form-label">Confirmation mot de passe</label>
    <input type="password" placeholder="Confirmation mot de passe" name="password_confirmation" maxlength="255" class="form-control" id="password_confirmation" required />
</div>