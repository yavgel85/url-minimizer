Symfony4 project: URL Minimizer
================================

### How to set up Application
1. Install dependencies - `composer install`
2. Configure database connection ** 
3. Run `./bin/console doctrine:database:create`
4. Run `./bin/console doctrine:schema:create`
5. Run `./bin/console server:run`

**Note:** you need to create .env file. 
 * copy .env.dist file and rename to .env
 * change default credentials to yours:
    * `DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name`
