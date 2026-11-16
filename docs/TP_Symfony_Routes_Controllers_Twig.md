# TP Symfony — Routes, Controllers et Templates Twig

**Public :** Licence Bac+3/4  
**Niveau :** débutant à intermédiaire  
**Durée indicative :** 2 h 30 à 3 h  
**Versions :** Symfony 7.4 / 8

## Objectifs pédagogiques

À la fin de ce TP, vous serez capables de :

- Déclarer des routes dans `config/routes.yaml` et avec les attributs PHP `#[Route]`.
- Associer une URL à une méthode de Controller.
- Retourner une réponse HTTP avec `Response`.
- Afficher un template Twig avec `render()`.
- Transmettre des données d'un Controller vers Twig.
- Utiliser les paramètres dynamiques dans les URL.
- Générer des liens avec la fonction Twig `path()`.
- Gérer un identifiant inexistant avec une erreur HTTP 404.

> **Remarque :** les « annotations » des anciens tutoriels Symfony correspondent aujourd'hui généralement à des **attributs PHP** (`#[Route]`).

## Préparation du projet

Utilisez un projet Symfony fonctionnel et installez Twig si nécessaire :

```bash
composer require symfony/twig-bundle
```

Les principaux fichiers utilisés seront :

```text
config/
    routes.yaml
src/
    Controller/
templates/
    base.html.twig
```

Pour inspecter les routes :

```bash
php bin/console debug:router
```

Pour la **partie 2**, vérifiez que votre projet charge les routes définies par attributs PHP dans `src/Controller/`. Dans une application Symfony standard, ce chargement est généralement déjà configuré. Si nécessaire, ajoutez cette configuration dans `config/routes.yaml` :

```yaml
controllers:
    resource: routing.controllers
```

> **Attention :** ne déclarez pas deux fois la même route (une fois en YAML et une fois par attribut) pendant les exercices.

---

# Partie 1 — Routes déclarées dans `routes.yaml`

## Exercice 1 — Première route et premier Controller

**Difficulté :** facile  
**Objectif :** comprendre la relation entre une URL et une méthode de Controller.

### Consignes

1. Créez un Controller `HomeController` dans `src/Controller`.
2. Ajoutez une méthode `index()` retournant un objet `Response`.
3. La réponse doit contenir le texte : « Bienvenue sur mon application Symfony ».
4. Déclarez dans `config/routes.yaml` une route nommée `app_home` accessible depuis `/`.
5. Testez la route dans le navigateur.

Exemple de route :

```yaml
app_home:
    path: /
    controller: App\Controller\HomeController::index
```

**Résultat attendu :** la page d'accueil affiche le message de bienvenue.

## Exercice 2 — Afficher un template Twig

**Difficulté :** facile  
**Objectif :** séparer la logique du Controller de l'affichage HTML.

### Consignes

1. Créez `templates/home/index.html.twig`.
2. Ajoutez un titre `<h1>` et un paragraphe de présentation.
3. Modifiez `HomeController::index()` pour utiliser `$this->render()`.
4. Faites hériter le template de `base.html.twig`.
5. Modifiez le titre de la page grâce au bloc Twig `title`.

Exemple :

```php
return $this->render('home/index.html.twig');
```

**Résultat attendu :** la page d'accueil affiche une page HTML générée par Twig.

## Exercice 3 — Transmettre des variables à Twig

**Difficulté :** facile  
**Objectif :** comprendre le passage de données entre Controller et template.

### Consignes

1. Créez un `UserController` avec une méthode `profile()`.
2. Déclarez dans `routes.yaml` une route `/profil`, nommée `app_profile`.
3. Définissez dans le Controller trois variables : `$name`, `$age` et `$city`.
4. Transmettez-les au template `user/profile.html.twig`.
5. Affichez ces informations dans une page HTML.

Exemple :

```php
return $this->render('user/profile.html.twig', [
    'name' => $name,
    'age' => $age,
    'city' => $city,
]);
```

**Résultat attendu :**

```text
Profil utilisateur
Nom : Alice Martin
Âge : 25 ans
Ville : Marseille
```

## Exercice 4 — Route avec un paramètre dynamique

**Difficulté :** intermédiaire  
**Objectif :** récupérer une valeur contenue dans l'URL.

### Consignes

1. Modifiez la route du profil pour accepter un prénom dans l'URL : `/profil/{name}`.
2. Adaptez la méthode du Controller pour récupérer le paramètre `name`.
3. Transmettez le prénom au template Twig.
4. Affichez le message « Bonjour » suivi du prénom.
5. Testez la route avec plusieurs prénoms.

Exemple de route :

```yaml
app_profile:
    path: /profil/{name}
    controller: App\Controller\UserController::profile
```

| URL | Affichage attendu |
| --- | --- |
| `/profil/alice` | Bonjour alice |
| `/profil/paul` | Bonjour paul |
| `/profil/marie` | Bonjour marie |

**Question :** comment Symfony fait-il correspondre `{name}` à l'argument de la méthode du Controller ?

---

# Partie 2 — Routes déclarées avec les attributs PHP

Les routes des exercices suivants sont déclarées directement dans les Controllers avec `#[Route]`. Ne créez pas de déclarations YAML individuelles pour ces routes.

Exemple de syntaxe :

```php
use Symfony\Component\Routing\Attribute\Route;

#[Route('/contact', name: 'app_contact')]
public function contact(): Response
{
    // ...
}
```

## Exercice 5 — Créer une page de contact

**Difficulté :** facile  
**Objectif :** déclarer une route avec un attribut PHP.

### Consignes

1. Créez `ContactController`.
2. Déclarez avec `#[Route]` une route `/contact`, nommée `app_contact`.
3. Créez le template `contact/index.html.twig`.
4. Affichez une adresse e-mail et un numéro de téléphone fictifs.
5. Vérifiez la présence de la route avec `php bin/console debug:router`.

**Résultat attendu :** une page de contact accessible depuis `/contact`.

## Exercice 6 — Paramètre dynamique et contraintes

**Difficulté :** intermédiaire  
**Objectif :** récupérer et contrôler un paramètre d'URL.

### Consignes

1. Créez un `ProductController` avec une méthode `show(int $id)`.
2. Déclarez avec `#[Route]` une route `/produit/{id}`, nommée `app_product_show`.
3. Ajoutez une contrainte autorisant seulement les identifiants composés de chiffres.
4. Transmettez l'identifiant au template Twig et affichez-le.
5. Testez des URL valides et invalides.

Exemple de déclaration :

```php
#[Route(
    '/produit/{id}',
    name: 'app_product_show',
    requirements: ['id' => '\d+']
)]
```

| URL | Résultat attendu |
| --- | --- |
| `/produit/5` | Affichage du produit 5 |
| `/produit/42` | Affichage du produit 42 |
| `/produit/abc` | Erreur HTTP 404 |

## Exercice 7 — Afficher une liste avec Twig

**Difficulté :** intermédiaire  
**Objectif :** transmettre un tableau PHP à Twig et utiliser une boucle.

Créez un `BookController` avec une méthode `index()` et une route `/livres`, nommée `app_books`.

Utilisez le tableau suivant dans le Controller :

```php
$books = [
    ['id' => 1, 'title' => 'Dune', 'author' => 'Frank Herbert'],
    ['id' => 2, 'title' => '1984', 'author' => 'George Orwell'],
    ['id' => 3, 'title' => 'Fondation', 'author' => 'Isaac Asimov'],
];
```

### Consignes

1. Transmettez le tableau `$books` au template.
2. Créez `book/index.html.twig`.
3. Affichez les livres dans une liste HTML avec une boucle Twig `{% for %}`.
4. Affichez pour chaque livre son titre et son auteur.
5. Affichez un message si la liste est vide, avec `{% else %}`.

**Résultat attendu :**

```text
Liste des livres
- Dune — Frank Herbert
- 1984 — George Orwell
- Fondation — Isaac Asimov
```

## Exercice 8 — Navigation entre la liste et le détail

**Difficulté :** intermédiaire +  
**Objectif :** relier plusieurs pages à l'aide des noms de routes.

Reprenez le `BookController` de l'exercice 7.

### Consignes

1. Ajoutez une méthode `show(int $id)`.
2. Déclarez avec `#[Route]` une route `/livres/{id}`, nommée `app_book_show`.
3. Recherchez dans le tableau le livre correspondant à l'identifiant reçu.
4. Transmettez le livre trouvé au template `book/show.html.twig`.
5. Dans la liste, ajoutez un lien « Voir le détail » pour chaque livre en utilisant `path()`.
6. Dans la page de détail, ajoutez un lien pour revenir à la liste.
7. Si aucun livre ne correspond à l'identifiant, renvoyez une erreur HTTP 404 avec `createNotFoundException()`.

Exemple de lien dans Twig :

```twig
<a href="{{ path('app_book_show', {id: book.id}) }}">
    Voir le détail
</a>
```

**Résultat attendu :** navigation entre la liste des livres et une fiche détaillée, avec une erreur 404 pour un livre inexistant.

---

# Bonus — Migrer des routes YAML vers des attributs PHP

Reprenez les routes de la première partie et convertissez-les en attributs `#[Route]` dans les Controllers.

### Consignes

1. Ajoutez les attributs PHP sur les méthodes concernées.
2. Supprimez les anciennes déclarations YAML correspondantes.
3. Conservez la configuration générale de chargement des attributs.
4. Vérifiez que les noms de routes et les URL n'ont pas changé.
5. Vérifiez que les pages continuent à fonctionner.

---

# Grille d'autoévaluation

- [ ] Je sais déclarer une route en YAML.
- [ ] Je sais déclarer une route avec `#[Route]`.
- [ ] Je sais associer une route à une méthode de Controller.
- [ ] Je sais retourner une `Response`.
- [ ] Je sais afficher un template avec `render()`.
- [ ] Je sais faire hériter un template de `base.html.twig`.
- [ ] Je sais transmettre des données d'un Controller vers Twig.
- [ ] Je sais récupérer un paramètre dynamique d'URL.
- [ ] Je sais afficher une liste avec une boucle Twig.
- [ ] Je sais générer des liens avec `path()`.
- [ ] Je sais gérer un élément inexistant avec une erreur 404.

## Rappel d'architecture

```text
Navigateur
    |
    v
URL / Requête HTTP
    |
    v
Route (routes.yaml ou #[Route])
    |
    v
Controller
    |
    v
Template Twig
    |
    v
Réponse HTML vers le navigateur
```

> **Conseil :** concentrez-vous uniquement sur le routage, les Controllers et Twig. L'utilisation de Doctrine, des formulaires Symfony et des services métiers viendra dans un second temps.
