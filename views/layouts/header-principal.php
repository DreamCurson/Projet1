<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lord Stampee</title>
    <link rel="stylesheet" href="{{ asset }}css/main.css" />
    <script type="module" src="{{ asset }}script/burger/menu-burger.js"></script>
  </head>

  <body>
    <header>
      <nav class="navigation">
        <div class="navigation__top">
          <img src="{{ img }}logo-bleu.png" alt="Logo" class="navigation__logo" />

          <button class="navigation__burger" aria-label="Ouvrir le menu">
            <span></span>
            <span></span>
            <span></span>
          </button>

          <div class="navigation__elements">
            <div class="navigation__recherche">
              <form action="recherche.html" method="get">
                <input
                  id="recherche"
                  type="text"
                  placeholder="Trouvez votre futur timbre..."
                  name="query"
                  class="navigation__recherche_input"
                  aria-label="Champ de recherche"
                />
                <button
                  type="submit"
                  class="navigation__recherche-bouton"
                  aria-label="Search"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    x="0px"
                    y="0px"
                    width="20"
                    height="15"
                    viewBox="0 0 26 26"
                    fill="white"
                  >
                    <path
                      d="M 10 0.1875 C 4.578125 0.1875 0.1875 4.578125 0.1875 10 C 0.1875 15.421875 4.578125 19.8125 10 19.8125 C 12.289063 19.8125 14.394531 19.003906 16.0625 17.6875 L 16.9375 18.5625 C 16.570313 19.253906 16.699219 20.136719 17.28125 20.71875 L 21.875 25.34375 C 22.589844 26.058594 23.753906 26.058594 24.46875 25.34375 L 25.34375 24.46875 C 26.058594 23.753906 26.058594 22.589844 25.34375 21.875 L 20.71875 17.28125 C 20.132813 16.695313 19.253906 16.59375 18.5625 16.96875 L 17.6875 16.09375 C 19.011719 14.421875 19.8125 12.300781 19.8125 10 C 19.8125 4.578125 15.421875 0.1875 10 0.1875 Z M 10 2 C 14.417969 2 18 5.582031 18 10 C 18 14.417969 14.417969 18 10 18 C 5.582031 18 2 14.417969 2 10 C 2 5.582031 5.582031 2 10 2 Z M 4.9375 7.46875 C 4.421875 8.304688 4.125 9.289063 4.125 10.34375 C 4.125 13.371094 6.566406 15.8125 9.59375 15.8125 C 10.761719 15.8125 11.859375 15.433594 12.75 14.8125 C 12.511719 14.839844 12.246094 14.84375 12 14.84375 C 8.085938 14.84375 4.9375 11.695313 4.9375 7.78125 C 4.9375 7.675781 4.933594 7.574219 4.9375 7.46875 Z"
                    ></path>
                  </svg>
                </button>
              </form>
            </div>

            <ul class="navigation__principal">
              <li class="navigation__element">
                <a href="index.html">Enchères</a>
              </li>
              <li
                class="navigation__element navigation__element--has-subcategories"
              >
                <a href="#">Actualités</a>
                <ul class="navigation__subcategories">
                  <li class="navigation__subcategory">
                    <a href="#">Timbres</a>
                  </li>
                  <li class="navigation__subcategory">
                    <a href="#">Enchères</a>
                  </li>
                  <li class="navigation__subcategory">
                    <a href="#">Bridge</a>
                  </li>
                </ul>
              </li>
              {% if privilege_id == 2 %}
                <li class="navigation__element">
                  <a href="#">Devenir membre</a>
                </li>
              {% endif %}

              {% if privilege_id == 2 %}
                <li class="navigation__element">
                  <a href="login">Se connecter</a>
                </li>
              {% elseif privilege_id == 1 %}
                <li class="navigation__element">
                  <a href="#">Votre profil</a>
                </li>
              {% endif %}
            </ul>
          </div>
        </div>

        <ul class="navigation__secondaire">
          <li
            class="navigation__element navigation__element--has-subcategories"
          >
            <a href="#">À propos de Lord Reginald Stampee III</a>
            <ul class="navigation__subcategories">
              <li class="navigation__subcategory">
                <a href="#">La philatélie, c’est la vie.</a>
              </li>
              <li class="navigation__subcategory">
                <a href="#">Biographie du Lord</a>
              </li>
              <li class="navigation__subcategory">
                <a href="#">Historique familial</a>
              </li>
            </ul>
          </li>
          <li
            class="navigation__element navigation__element--has-subcategories"
          >
            <a href="#">Fonctionnement de la plateforme</a>
            <ul class="navigation__subcategories">
              <li class="navigation__subcategory">
                <a href="#">« Profil »</a>
              </li>
              <li class="navigation__subcategory">
                <a href="#">« Comment placer une offre »</a>
              </li>
              <li class="navigation__subcategory">
                <a href="#">« Suivre une enchère »</a>
              </li>
              <li class="navigation__subcategory">
                <a href="#">« Trouver l’enchère désirée »</a>
              </li>
              <li class="navigation__subcategory">
                <a href="#">Contacter le webmestre</a>
              </li>
            </ul>
          </li>
          <li
            class="navigation__element navigation__element--has-subcategories"
          >
            <a href="#">Contactez-nous</a>
            <ul class="navigation__subcategories">
              <li class="navigation__subcategory">
                <a href="#">Angleterre</a>
              </li>
              <li class="navigation__subcategory"><a href="#">Canada</a></li>
              <li class="navigation__subcategory"><a href="#">US</a></li>
              <li class="navigation__subcategory"><a href="#">Australie</a></li>
            </ul>
          </li>
          <li class="navigation__element">
            <a href="#">Termes et conditions</a>
          </li>
        </ul>
      </nav>
    </header>