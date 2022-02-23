# Prep Network Wordpress Code Challenge

## Overview

This exercise will have the candidate solve 2 mini-challenges in a Wordpress environment. The purpose of the challenge is to test your skills in Wordpress, PHP, and design.

Here are the guidelines for this exercise:

## Required Dependencies

| Name      | Download                                             |
| --------- | ---------------------------------------------------- |
| Wordpress | https://wordpress.org/download                       |
| Yarn      | https://yarnpkg.com/lang/en/docs/install/#mac-stable |

## Setting Up Your Environment

1. Create a new instance of Wordpress on your local system. We recommend https://localwp.com/ for local Wordpress development, but use the local setup tool that you are most comfortable with.

2. Install the Sage Wordpress Starter theme included in the repository into your newly created Wordpress site.

3. Active the theme in the Wordpress admin.

4. If needed, utilize the theme documentation installation instructions: https://roots.io/sage/docs/theme-installation/.

5. Using the Wordpress import tool, import the included import.xml file, which will populate your database with ~300 posts. The import tool can be found in the dashboard at Tools -> Import.

6. Compile the theme CSS & JS by running the following commands from the theme directory:

```
yarn
yarn build
```

### Install Tip
-   If yarn fails to compile on the first build and produces an error similar to: '7 errors generated.make: *** [Release/obj.target/binding/src/binding.o]Error 1 gyp ERR! build error' run the following commands: 

```
yarn remove node-sass 
yarn install 
yarn add node-sass
```

## Challenge Requirements

### Challenge 1 - Customize a Post Aggregator

Your task is to update an existing post aggregator with the updates below. You can view this file on your site by viewing the 'Post Aggregator' page that was automatically created upon installing the theme.

These updates will be made to the /sage/resources/views/template-post-aggregator.blade.php page template file.

1. Trim all post titles longer than 30 characters and include an elipses (...) at the end of the title.

Example: 

```
Prep Girls Hoops South Carolina: The Rankings -> Prep Girls Hoops South Caro...
```

2. Update the post query to only query posts with the taxonomy of Minnesota. The state taxonomy can be viewed in the dashboard at Posts -> States.

3. Below the post title, display the post category and state taxonomy. If the post contains multiple of either, display the first item in each list. Use Bootstrap badges to style the tags - https://getbootstrap.com/docs/4.0/components/badge/.

4. Add a filter in app/filters.php to prepend the term 'National - ' to the post title if the post is tagged to multiple states.

Example: 

```
Introducing RecruitMe from Prep Girls... -> National - Introducing RecruitMe from...
```

After these updates, the aggregator should resemble the image below:

![Final Aggregator](https://www.prepnetwork.com/wp-content/uploads/2022/02/Screen-Shot-2022-02-21-at-10.32.36-PM.png)

### Challenge 2 - Build an Event Aggregator

Your task is to build an event aggregator using the Prep Network events API. These updates will be made to the /sage/resources/views/template-event-aggregator.blade.php page template file.

1. Utilize the following API endpoint as the data source for your aggregator: 

```
https://events.prephoops.com/api/events?website_id=1&type=tournament&date=upcoming&sortBy=start_date
```

2. Loop through each event result from the API to build a grid of events. Utilize the Bootstrap grid to display a 3-column layout of events.

3. Utilize the title, logo, and registration_url properties to display the necessary information for each event.

4. Update the design to match the screenshot below. You should be able to replicate this design using Bootstrap classes. If you need to add any custom styles, update the following .scss file: sage/resources/assets/styles/common/_event-aggregator.scss

To compile your CSS, run the following command:

```
yarn build
```

![Event Aggregator](https://www.prepnetwork.com/wp-content/uploads/2022/02/Screen-Shot-2022-02-22-at-8.47.19-AM.png)

## Project Submission

-   Complete the challenge and return the updated theme files in a zip file to travis@prepnetwork.com.
-   Within the email, please provide details on anything you may have struggled with or anything else you want us to know related to the challenge.
