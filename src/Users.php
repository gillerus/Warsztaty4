<?php

/**
 * Description of Users
 *
 * @author coderslab
 */
class Users {

    private $id;
    private $name;
    private $surname;
    private $email;
    private $hashedPassword;
    private $address;

    public function __construct() {
        $this->id = -1;
        $this->name = "";
        $this->surname = "";
        $this->email = "";
        $this->hashedPassword = "";
        $this->address = "";
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($setName) {
        $this->name = $setName;
        return $this->name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function setSurname($setSurname) {
        $this->username = $setSurname;
        return $this->surname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($setEmail) {
        $this->email = $setEmail;
        return $this->email;
    }

    public function getHashedPassword() {
        return $this->hashedPassword;
    }

    public function setHashedPassword($setPassword) {
        $newHashedPassword = password_hash($setPassword, PASSWORD_BCRYPT);
        $this->hashedPassword = $newHashedPassword;
        return $this->hashedPassword;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($setAddress) {
        $this->email = $setAddress;
        return $this->address;
    }

    public function saveToDB(mysqli $connection) {

        if ($this->id == -1) {

            $sql = "INSERT INTO Users(name, surname, email, hashed_hassword, address) VALUES ('$this->name', '$this->surname', '$this->email', '$this->hashedPassword', '$this->address')";

            $result = $connection->query($sql);

            if ($result == true) {
                $this->id = $connection->insert_id;
                return true;
            }
        } else {

            $sql = "UPDATE Users SET name='$this->name', surname='$this->surname', email='$this->email', hashedPassword='$this->hashedPassword', address='$this->address' WHERE id=$this->id";

            $result = $connection->query($sql);

            if ($result == true) {
                return true;
            }
        }

        return false;
    }

    static public function loadUserById(mysqli $connection, $id) {

        $sql = "SELECT * FROM Users WHERE id=$id";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {

            $row = $result->fetch_assoc();

            $loadedUser = new Users();

            $loadedUser->id = $row['id'];
            $loadedUser->name = $row['name'];
            $loadedUser->surname = $row['surname'];
            $loadedUser->email = $row['email'];
            $loadedUser->hashedPassword = $row['hashedPassword'];
            $loadedUser->address = $row['address'];

            return $loadedUser;
        }

        return null;
    }

    static public function loadAllUsers(mysqli $connection) {

        $sql = "SELECT * FROM Users";
        $ret = [];
        $result = $connection->query($sql);

        if ($result == true && $result->num_rows != 0) {

            foreach ($result as $row) {

                $loadedUser = new Users();

                $loadedUser->id = $row['id'];
                $loadedUser->name = $row['name'];
                $loadedUser->surname = $row['surname'];
                $loadedUser->email = $row['email'];
                $loadedUser->hashedPassword = $row['hashedPassword'];
                $loadedUser->address = $row['address'];

                $ret[] = $loadedUser;
            }
        }

        return $ret;
    }

    public function deleteUser(mysqli $connection) {

        if ($this->id != -1) {
            $sql = "DELETE FROM Users WHERE id=$this->id";
            $result = $connection->query($sql);

            if ($result == true) {
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }

}
