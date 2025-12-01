{{ include('layouts/header-connexion.php') }}

<body class="auth">
  <main class="auth__main">
    <section class="auth__welcome">
      <h1 class="auth__welcome-title">Connexion</h1>
    </section>

    <section class="auth__section">
      <form class="auth__form" method="post">
        <div class="auth__field">
          <label class="auth__label" for="email">Email</label>
          <input class="auth__input" type="email" id="email" name="email" required>
        </div>
        <div class="auth__field">
          <label class="auth__label" for="password">Mot de passe</label>
          <input class="auth__input" type="password" id="password" name="password" required>
        </div>
        <button class="auth__submit" type="submit">Connexion</button>
      </form>

      <div class="auth__options">
        <p class="auth__text">Pas encore membre ? <a class="auth__link" href="inscription">Inscription</a></p>
        <a class="auth__guest" href="guest">Continuer en tant qu'invité</a>
      </div>
    </section>
  </main>
</body>
