# Hooky

Hooky is a Brand new dating app built by the community With the important QoL and safety features missing from most hookup/dating apps today

Contributors to the app will be granted a free membership to the highest tier subscription for as long as they are activley contributing to the app (minimum 3 months guaranteed) and will be granted a special Contributor decal on their profile!

Anybody is permitted to submit changes as pull requests to the repo. Any new features you submit will be subject to review and may not be approved. This is at the sole discresion of Vulps22 and will generally be based on a number of factors such as Security, aesthetics, easy of use, etc. Consideration will also be given to how useful the feature is and if it fits well with the mood of the app.

## You are not allowed to redistribute this code or deploy it for personal, or comercial use.
Vulps22 at all times and without exception retains all rights and privelages relating to the code, and it's finished products. The app, and it's code, is the property of Vulps22 and he alone is permitted to deploy the app for public use, or for use outwith the development process.

Planned and in progress features can be viewed from the Roadmap at [Clickup](https://sharing.clickup.com/9005087157/l/h/6-900500991817-1/2d4c826cb6ad3a5)

Anybody can join our community on [Discord](https://discord.gg/Qh9JW7Mx) where you can discuss feature ideas for the roadmap, or ask for access to the Clickup if you wish to activley contribute

# Setup

Hooky runs on an apache using PHP for the backend, and Vue (Html/Typescript) for the front end. Development has thus far taken place on Windows and as such ther following instructions are for windows users and may differ for apple/linux users.

To start with you're going to require [XAMPP](https://www.apachefriends.org/download.html) [composer](https://getcomposer.org/download/) and [nodeJS](https://nodejs.org/en/download)

When you have them installed, Clone the repo into your XAMPP's htdocs folder and launch Xampp. Make sure to start Apache and MySQL before continuing

find the file <still to be committed> and import it into the PHPMyAdmin (click the 'admin' button for MySQL on XAMPP) interface to create a clone of the database structure (no data)

You're going to want to run `composer install` and let it install any dependencies.

Then you will need to use `cd app/hooky` and run `npm install`

When that's complete you should be able to launch the front end in development with `npm run dev`
