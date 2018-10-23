# Cours Projet 3eme ISL


## Example index

- [Cloudinary example](Cours/cloudinary-example/README.md)

## Tooling
- [Git cheat sheet](https://www.git-tower.com/blog/git-cheat-sheet)

- [Cloudinary as a CDN for images](https://cloudinary.com)

  Storing data in DB as blob will lead to big threatment in your backend, also heavy bandwitdh usage that can impact performance of your website.

  Two ways to fixed this:

  1-**Simple one**: Using `public/assets` folder: You can store your images in `public/assets`, use the *path* as image URL in DB, and use `asset` macro to render url in *Twig* template

  2-**Production-like one**: 

    Use a CDN (*Content delivery network*). The CDN will store the image for you and will provide you an fixed url to get the image back. This URL will be stored in the DB as image URL.
  
    The advantage is the CDN will be region related. You will decrease the latency to access the images, reduce the bandwith allocated to your website itself, and reduce the storage size of your server and DB.

## PHP

### Symphony
- [How to Embed Controllers in a Template](https://symfony.com/doc/current/templating/embedding_controllers.html)
  Useful when you want to insert the same data at many places on a website (eg. items in the menu and the sidebar)

  **Don't use all over the place!** Too much usage lead to drop of performance.

- [Inheritance Mapping in Doctrine](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/inheritance-mapping.html#class-table-inheritance)
  When you have an inheritance in you PHP code, you can map it in your DB with doctrine annotations.

  ```php
    namespace MyProject\Model;

    /**
    * @Entity
    * @InheritanceType("JOINED")
    * @DiscriminatorColumn(name="userType", type="string")
    * @DiscriminatorMap({"user" = "User", "vendor" = "Vendor"})
    */
    class User
    {
        // ...
    }

    /** @Entity */
    class Vendor extends User
    {
        // ...
    }
  ```

  `@InheritanceType("JOINED")`: means you will have 2 separated tables `User` and `Vendor` in your DB, with no duplicated field in vendor. `Doctrine` will make a `JOIN` query when it will retrieve the data.

  `@DiscriminatorColumn(name="userType", type="string")`: To make the difference between `Vendor` type and `User` type, `Doctrine` needs a column that explicitely show the difference. This is called `DiscriminatorColumn` and `Doctrine` will create that column automatically, with the `name` and `type` provided. *(eg. here: `name="userType", type="string"`)*

  `@DiscriminatorMap({"user" = "User", "vendor" = "Vendor"})`: You have to define all types your inheritance child can have. *(eg. here: `{"user" = "User", "vendor" = "Vendor"}`)
  The format of argument is a key-value like this: `"identifier=EntityName"`

  

    

