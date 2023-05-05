# MessageBoard

Le projet consiste en la création d'un message board où les utilisateurs peuvent poster des messages dans des salons. Chaque utilisateur est identifié et ne peut pas poster deux messages consécutifs sauf si leur dernier message date de plus de 24 heures.

## Installation

Clonez ce dépôt sur votre serveur local ou distant.

Configurez votre serveur pour pointer vers le dossier du projet(src).

## Utilisation

Pour verifier si toute l'installation s'est bien déroulée:
Vous pouvez essayer de vous connecter en cliquant sur le bouton "Se connecter" et en ajoutant un salon.

## Structure des tests
- __features__
  - __test__: Contient les test jeset
  - __bootstrap__:Contient les testes fonctionnelle
  - FeatureContext.php: Contient les test écris en Gherkin
- __tests__: Contient les test PHPUnit
## Tests
Behat

Behat est utilisé pour les tests d'acceptation. Pour lancer les tests, exécutez la commande suivante dans le répertoire du projet :

```php
./vendor/bin/behat    
```
Les scénarios testés sont:
- Creating a salon
- Creating a user
- Deleting a user
- Posting a message

Les méthodes testées sont:
- iHaveAnInstanceOfORMMemory
- iCreateASalonNamed
- theSalonShouldExistInTheListOfSalons
- iCreateAUserNamed
- theUserShouldExistInTheListOfUsers
- iDeleteTheUser
- theUserShouldNotExistInTheListOfUsers
- iPostAMessageInTheSalon
- theSalonShouldContainJohnsMessage

PHPUnit

PHPUnit est utilisé pour les tests unitaires. Pour lancer les tests, exécutez la commande suivante dans le répertoire du projet :

```php
./vendor/bin/phpunit tests/
```
Les méthodes testées sont :
- createSalon()
- getMessages()
- deleteAllSalons()
- createUser()
- getUserMessages()
- deleteUser()
- getUserByUsername() (dans l'interface)
- postMessage() (dans l'interface)

Jest

Jest est utilisé pour les tests unitaires en JavaScript. Pour lancer les tests, exécutez la commande suivante dans le répertoire du projet :

```javascript
npm test
```
Les fonctions testées sont :

- validateCreateSalonForm()
- validateLoginForm()
- validatePostMessageForm()
- setupCreateSalonModal()
- setupLoginModal()


