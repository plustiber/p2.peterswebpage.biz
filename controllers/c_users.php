<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 

    public function index() {
        echo "This is the index page";
    }

    public function signup() {

       # Set up the view
       $this->template->content = View::instance('v_users_signup');
       $this->template->title   = "Sign Up";
       
       # Render the view
       echo $this->template;

    }

    # Processes the data entered by the user in the "users_signup_form"
    # Data is passed to the function via _POST variable.  It contains:
    #   first_name => First Name;
    #   last_name => Last Name;
    #   email => Email;
    #   password => Password;

    public function p_signup() {
                
        # More data we want stored with the user
        $_POST['created']  = Time::now();
        $_POST['modified']  = Time::now();

        # Encrypt the password
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        # Create an encrypted token via their email address and a random string
        $_POST['token']    = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
        
        #echo "<pre>";
        #print_r($_POST);
        #echo "<pre>";
        
        # Insert the information into the database
        DB::instance(DB_NAME)->insert_row('users', $_POST);
        
        # Send them to the login page
        Router::redirect('/users/login');
        
    }

    public function login($error = NULL) {

        # Set up the view
        $this->template->content = View::instance('v_users_login');
        $this->template->title   = "Login";

        # Append error message (if any) to the view
        $this->template->content->error = $error;

        # CSS/JS includes
        $client_files_head = Array("/css/p2.css");
        $this->template->client_files_head = Utils::load_client_files($client_files_head);

        # Render the view
        echo $this->template;

    }

    # Processes the data entered in the "users_login_form"
    # Data is passed to the function via _POST variable.  It contains:
    #   email => Email;
    #   password => Password;

    public function p_login() {
                
        # Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        # Hash submitted password so we can compare it against one in the db
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        # Search the db for this email and password
        # Retrieve the token if it's available
        $q = "SELECT token 
            FROM users 
            WHERE email = '".$_POST['email']."' 
            AND password = '".$_POST['password']."'";

        $token = DB::instance(DB_NAME)->select_field($q);

        # If we found a matching token in the database, it means login succeeded
        if($token) {

            /* 
            Store this token in a cookie using setcookie()
            Important Note: *Nothing* else can echo to the page before setcookie is called
            Not even one single white space.
            param 1 = name of the cookie
            param 2 = the value of the cookie
            param 3 = when to expire
            param 4 = the path of the cooke (a single forward slash sets it for the entire domain)
            */
            setcookie("token", $token, strtotime('+2 weeks'), '/');

            # Send them to the main page - or whever you want them to go
            Router::redirect("/");

        # Otherwise, login failed 
        } else {

            # Send them back to the login page
            Router::redirect("/users/login/error");

        }
    }

    public function logout() {

        # Generate and save a new token for next login
        $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

        # Create the data array we'll use with the update method
        # In this case, we're only updating one field, so our array only has one entry
        $data = Array("token" => $new_token);

        # Do the update
        DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

        # Delete their token cookie by setting it to a date in the past - effectively logging them out
        setcookie("token", "", strtotime('-1 year'), '/');

        # Send them back to the main index.
        Router::redirect("/");

    }

    public function profile($error = NULL) {
        
        # If user isn't blank, they're logged in - display profile
        if($this->user) {
            # Setup view
            $this->template->content = View::instance('v_users_profile');
            $this->template->title   = "Profile of ".$this->user->first_name;

            # Append error message (if any) to the view
            $this->template->content->error = $error;

            # CSS/JS includes
            $client_files_head = Array("/css/p2.css");
            $this->template->client_files_head = Utils::load_client_files($client_files_head);

            # Render template
            echo $this->template;
        
        # Otherwise, they're not logged in; redirect them to the login page
        } else {
            Router::redirect('/users/login');
        }
    }

    public function is_valid_email($email) {

        $q = "SELECT token 
            FROM users 
            WHERE email = '".$email."' 
            AND user_id != '".$this->user->user_id."'";

        echo $q;

        return (DB::instance(DB_NAME)->select_field($q) == "");

    }

    public function p_profile() {
        
        # Update the last modiefied time
        $_POST['modified']  = Time::now();

        # Determine if the email entered is unique
        $q = "SELECT token 
            FROM users 
            WHERE email = '".$_POST['email']."' 
            AND user_id != '".$this->user->user_id."'";

        $token = DB::instance(DB_NAME)->select_field($q);

        #if (!valid_email($_POST['email']))
        # If unique, update the information in the database
        if ($token == "") {
            # Update the information in the database
            $where_condition = "WHERE user_id = '".$this->user->user_id."'";
            DB::instance(DB_NAME)->update_row('users', $_POST, $where_condition);
            Router::redirect("/");

        # Otherwise, alert user      
        } else {
            Router::redirect("/users/profile/error");
        }

        # Dump out the results of POST to see what the form submitted
/*
        echo '<pre>';
        print_r($_POST);
        print_r($this->user);
        echo '</pre>';          
*/

    }

} # end of class