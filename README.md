## Reproduction Repo for https://github.com/laravel/nova-issues/issues/4308

### Steps to reproduce

1. run ```composer install```
2. run ```php artisan nova:install```
3. run ```php artisan migrate```
4. Create a new user using ```php artisan nova:user```
5. Go to http://localhost/nova/login and login
6. You should now see the screen for enabling two-factor authentication, proceed
7. After having completed the two-factor authentication setup you should get logged in
8. Log out
9. Log in again with the same user 
10. You **should** be redirected to the two-factor authentication challenge screen, but you **will** be redirected to the login screen again.

### This is why it happens

1. The login post request is attempted from ``` await this.form.post(Nova.url('/login')) ``` in ```vendor/laravel/nova/resources/js/pages/Login.vue```
2. The response delivers the redirect parameter which is handled by ``` window.location.href = redirect ```
3. After that ```Nova.visit('/')``` is being called which triggers a redirect to the login page because the user is not yet logged in (because fortify's two factor challenge is pending)

However, the running order of ```window.location.href``` vs ```Nova.visit('/')``` is not always the same - sometimes it works, sometimes it doesn't. But most of the time it does not...
A possible fix would be to change Login.vue as follows:

```
async attempt() {
    const { redirect } = await this.form.post(Nova.url('/login'))
    
    if (redirect !== undefined && redirect !== null) {
        window.location.href = redirect
    } else {
        Nova.visit('/')
    }
    
},
```

There are other possible fixes, e.g. overriding Nova's ```Authenticate``` middleware and check there if a two-factor challenge is going on.

**Note:** In this implementation of two-factor authentication it is possible to skip the setup of the 2FA and go directly to the nova dashboard. However, this behaviour might not be desired.
