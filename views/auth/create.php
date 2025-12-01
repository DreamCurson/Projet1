{{ include('layouts/header-connexion.php') }}

<body class="auth">
  <main class="auth__main">
    <section class="auth__welcome">
      <h1 class="auth__welcome-title">Devenez membre et débloquer...</h1>
    </section>

    <section class="auth__section">
      <h2 class="auth__section-title">Inscription</h2>
      <form class="auth__form" method="POST">
        <div class="auth__field">
          <label class="auth__label" for="name">Nom d'utilisateur</label>
          <input class="auth__input" type="text" id="name" name="name">
        </div>
        <div class="auth__field">
          <label class="auth__label" for="email">Email</label>
          <input class="auth__input" type="email" id="email" name="email">
        </div>
        <div class="auth__field">
          <label class="auth__label" for="password">Mot de passe</label>
          <input class="auth__input" type="password" id="password" name="password">
        </div>
        <button class="auth__submit" type="submit">S'inscrire</button>
      </form>

      <div class="auth__options">
        <p class="auth__text">Déjà membre ? <a class="auth__link" href="login">Connexion</a></p>
        <a class="auth__guest" href="guest">Continuer en tant qu'invité</a>
      </div>
    </section>
  </main>
</body>
