<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        //echo "users_controller construct called<br><br>";
    } 

    public function index() {
        echo "This is the index page";
    }

    public function signup() {
        echo "This is the signup page";
    }

    public function login() {
        echo "This is the login page";
    }

    public function logout() {
        echo "This is the logout page";
    }

    public function profile($user_name = NULL) {
        
        # Set up the View
        $this->template->content = View::instance('v_users_profile');
        $this->template->title = "Profile";
        
        # Load client files
        $client_files_head = Array(
            '/css/profile.css',
            );
        
        $this->template->client_files_head = Utils::load_client_files($client_files_head);
        
        $client_files_body = Array(
            '/js/profile.js'
            );
        
        $this->template->client_files_body = Utils::load_client_files($client_files_body);
        
        # Pass the data to the View
        $this->template->content->user_name = $user_name;
        
        # Display the view
        echo $this->template;
            
        //$view = View::instance('v_users_profile');
        //$view->user_name = $user_name;        
        //echo $view;
        
    }

} # end of class