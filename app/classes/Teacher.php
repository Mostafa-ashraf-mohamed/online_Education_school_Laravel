<?php
namespace App\classes;
use Illuminate\Support\Facades\DB;
class Teacher {
        private $id;
        private $fname;
        private $lname;
        private $gender;
        private $email;
        private $img;
        private $Sid;
        private $phNumber;
        private $password;


        public function __construct ($id,$fname,$lname,$gender,$email,$img,$Sid,$phNumber,$password){
            $this->id = $id;
            $this->fname = $fname;
            $this->lname = $lname;
            $this->gender = $gender;
            $this->email = $email;
            $this->img = $img;
            $this->Sid = $Sid;
            $this->phNumber = $phNumber;
            $this->password = $password;
        }

        public function getId (){
            return $this->id;
        }

        public function setId ($id){
            $this->id = $id;
        }

        public function getFname (){
            return $this->fname;
        }

        public function setFname ($fname){
            $this->fname = $fname;
        }

        public function getLname (){
            return $this->lname;
        }

        public function setLname ($lname){
            $this->lname = $lname;
        }

        public function getGender (){
            return $this->gender;
        }

        public function setGender ($gender){
            $this->gender = $gender;
        }

        public function getEmail (){
            return $this->email;
        }

        public function setEmail ($email){
            $this->email = $email;
        }

        public function getImg (){
            return $this->img;
        }

        public function setImg ($img){
            $this->img = $img;
        }

        public function getSid (){
            return $this->Sid;
        }

        public function setSid ($Sid){
            $this->Sid = $Sid;
        }

        public function getPhNumber (){
            return $this->phNumber;
        }

        public function setPhNumber ($phNumber){
            $this->phNumber = $phNumber;
        }

        public function getPassword (){
            return $this->password;
        }

        public function setPassword ($password){
            $this->password = $password;
        }
        public function save(){
            $update = DB::table('teachers')
            ->where('T_id', $this->getId())
            ->update([
                'T_fname' => $this->getFname(),
                'T_lname' => $this->getLname(),
                'T_phNumber' => $this->getPhNumber(),
                'T_password' => $this->getPassword(),
                'T_gender' =>$this->getGender(),
                'S_id'=>$this->getSid(),
                'T_email' => $this->getEmail(),
                'T_img' =>$this->getImg(),
                'T_password' =>$this->getPassword(),
            ]);
        }
    }
