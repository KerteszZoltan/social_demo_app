Project description:
bárki regisztrálhat, a regisztrációkor bekérendő adatok: név, email cím, jelszó
nem kell email értesítés, az admin felhasználó bírálja el a regisztrációs igényeket
az engedélyezett felhasználók az email címük és jelszavuk beírásával beléphetnek a rendszerbe
a rendszerben szereplő felhasználókat listázhatják és ismerősnek jelölhetik.
Az ismerősnek jelölésről a másik felhasználó értesítést kap. Ha legközelebb belép, eldöntheti, hogy elfogadja-e az ismerősnek jelölést (vissza is utasíthatja).
Mindkét esetben a jelölő felhasználó erről értesítést kap.

The project is containerized, so if you want run it, need setup the Docker. 

After download need regenerate the autoload files with "composer install" command.

You need rename the .env.example to .env . After you do this, need regenerate the app key with the "php artisan key:generate" command. 

Please, check that the "/database/database.sqlite" there is. If it is missing, create for manual.

For the run the project right click on the docker-compose.yml file and choose the "Compose Up".

Now, you need run the migration with docker. This command will help for you: docker-compose exec app php artisan migrate:refresh

Not neccessary but I like run this command before start the project: php artisan config:clear

You need install the npm dependencies with the "npm i" command. 

You need run the Vite with the "npm run dev" command.

Information for the app: 
The first registrated user is admin and active, other users will inactive.
Everybady can singup for the app, only need name, email and password. After registration can login IF the admin user will activate the account.
The user who have active account can login with email address and password.
The Registartion and Login page is public, other pages protected with middlewear.
Only the admin users see the promote administrator and activate options. It can be activated by one user at a time. 
The user can add other user to friend list. The add method make notification for the target user. The target user see the notifaication and can make decision for accept or decline the friend request. The system send back notification based on the choice.
The user friends have 3 state, "pending", "accepted", "declined". The state depends on the other user response.
