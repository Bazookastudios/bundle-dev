# Bazookas AdminBundle

This bundle contains code for managing security related tasks.

## Installing
### With composer
Add the following to composer.json (composer will ask authentication for private bundles the first time you install a bazookas bundle)
```json
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/Bazookastudios/BazookasSecurityBundle.git"
        }
    ],
```

And then: `composer require bazookas/security-bundle`

### As a git submodule
Use this command in the root of your repository to add this bundle as a submodule.

```bash
git submodule add -b master --name SecurityBundle https://github.com/Bazookastudios/BazookasSecurityBundle.git ./src/Bazookas/SecurityBundle
```

##TODO add documentation

- TODO migrate api token authentication to this bundle
- TODO migrate forgot password functionality to this bundle
