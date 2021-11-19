# knoppys-custom-pages-admin

Download the zip file and extract on your desktop so we can make some quick edits. 
Alternativly you can install the plugin as it is and edit it on your server. Personally I would make your edits on your computer before uploading to a live site. 

Open the file inside the extracted folder in somethign like notepad and youll see some code. Dont worry, this is pretty easy. 


On about line 31 you'll see this.
These lines remove menu items from the WordPress admin menu, this will help keep things cleaner.
Some other items can be harder to remove but if you check google for the right text to use between the ()'s
for the item you want to remove, you'll find it somewhere. Contact Form 7 can be  abit of a pain to remove. 
You can leave them all in there (especially 'edit.php?post_type=page') or you can remove as you please. 
```
//Clean up the admin by removing some of the pages
remove_menu_page( 'index.php' );                  //Dashboard
remove_menu_page( 'edit.php?post_type=page' );    //Pages
remove_menu_page( 'edit-comments.php' );          //Comments
remove_menu_page( 'themes.php' );                 //Appearance
remove_menu_page( 'plugins.php' );                //Plugins
remove_menu_page( 'users.php' );                  //Users
remove_menu_page( 'tools.php' );                  //Tools
remove_menu_page( 'options-general.php' );        //Settings
```

On about line 54 you'll see this.
Add your own comma seperated list of page ID's you want the user to be able to access. 
```
'post__in' => [ 123 , 456 , 789 , 654 , 321 ],
```
Now you can zip the plugin folder back up and install it as you normally would. 

Activate the plugin and log in as a user with an Editor role and you'll see some differences, including a new menu item called Pages.
