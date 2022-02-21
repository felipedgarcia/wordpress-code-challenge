# Prep Network Wordpress Code Challenge

## Overview

This exercise will have the candidate build an infinite scroll post aggregator which is triggered by a "Load More" button using ajax and PHP. The purpose of the challenge is to test your skills in PHP, Javascript, and design.

Here are the guidelines for this exercise:

## Required Dependencies

| Name      | Download                                             |
| --------- | ---------------------------------------------------- |
| Wordpress | https://wordpress.org/download                       |
| Yarn      | https://yarnpkg.com/lang/en/docs/install/#mac-stable |
| Composer  | https://getcomposer.org/download                     |

## Setting Up Your Enviornment

1. Create a new instance of Wordpress using the download link provided above.

2. Using the Wordpress import tool, import the included import.xml file, which will populate your database with ~300 posts.

3. Install the Sage Wordpress Starter theme included in the repository into your newly created Wordpress site.

4. Once installed, navigate to the Sage theme directory and run 'composer install'.

5. After composer has finished, run 'yarn' to install all the necessary dependencies.

6. If needed, utilize the theme documentation installation instructions: https://roots.io/sage/docs/theme-installation/.

## Challenge Requirements

### Challenge 1

Your task is to update an existing post aggregator with the updates below. These updates will be made to the /sage/resources/views/template-post-aggregator.blade.php page template file. You can view this file on your site by viewing the 'Post Aggregator' page that was automatically created upon installing the theme.

1. Trim all post titles longer than 30 characters and include an elipses (...) at the end of the title

Example: 

```
Prep Girls Hoops South Carolina: The Rankings -> Prep Girls Hoops South Caro...
```

2. Update the post query to only query posts with the taxonomy of Minnesota. The state taxonomy can be viewed in the dashboard at Posts -> States

3. Restrict the post query to posts published within the last 30 days

4. Below the post title, display the post category and state taxonomy. If the post contains multiple of either, display the first item in each list.

After these updates, the aggregator should resemble the image below:

![Final Aggregator](https://www.prepnetwork.com/wp-content/uploads/2022/02/Screen-Shot-2022-02-21-at-9.05.04-AM.png)

## Project Submission

-   Complete the challenge and return the updated theme files in a zip file to travis@prepnetwork.com.
-   Within the email, please provide any details related to the location of your PHP, JS and CSS code, what you struggled with, and anything else you want us to know.

## Tips
-   If yarn fails to compile on the first build and produces an error similar to: '7 errors generated.make: *** [Release/obj.target/binding/src/binding.o]Error 1 gyp ERR! build error' run the following commands: 
1) yarn remove node-sass 
2) yarn install 
3) yarn add node-sass
