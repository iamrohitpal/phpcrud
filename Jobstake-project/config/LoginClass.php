<?php
include "AutoloadClass.php";

class LoginClass extends DbConnection
{
    public function loginCredentialCheck($request)
    {
        if (array_key_exists('email',$request) && array_key_exists('password',$request)) {
            $loginData = [
                'email' => $request['email'],
                'password' => md5($request['password'])
            ];
            $data = $this->getData('admin_login', ['where' => $loginData, 'return_type' => 'single']);
            if (!empty($data)) {
                return [
                    'success' => true,
                    'message' => 'Login Successfully!',
                    'data' => $data
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Enter Correct Email Id And Password',
                    'data' => []
                ];
            }
        } else {
            return false;
        }
    }
    public function userAuthentication($request)
    {
        if (isset($_SESSION['admin'])) {
            header("location:dashboard.php");
        }
        if (isset($_REQUEST['submit'])) {
            $result = $this->loginCredentialCheck($request);
            if (!empty($result['success'])) {
                $_SESSION['admin'] = $result['data'];
                header("location:dashboard.php");
            } else {
                header("location:login.php?msg=1");
            }
        }
    }
}