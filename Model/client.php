<?php 
class Client{
		private $id;
		private $nom;
        private $prenom;
        private $email;
        private $mdp;
		private $tel;
		private $adresse;
		private $sexe;
		private $date_nais;
		private $role;
		private $statut;

		public function __construct($nom,$prenom,$email,$mdp,$tel,$adresse,$sexe,$date_nais,$role,$statut){
        $this->nom=$nom;
        $this->prenom=$prenom;
        $this->email=$email;
        $this->mdp=$mdp;
        $this->tel=$tel;
        $this->adresse=$adresse;
        $this->sexe=$sexe;
        $this->date_nais=$date_nais;
        $this->role=$role;
        $this->statut=$statut;
		}
		public function getid(){
			return $this->id;
		}
		public function getNom(){
			return $this->nom;
		}
		public function getPrenom(){
			return $this->prenom;
		}
		public function getEmail(){
			return $this->email;
        }
        public function getMdp(){
			return $this->mdp;
        }
        public function getTel(){
			return $this->tel;
        }
        public function getAdresse(){
			return $this->adresse;
        }
        public function getSexe(){
			return $this->sexe;
        }
        public function getDateNais(){
			return $this->date_nais;
        }
        public function getRole(){
			return $this->role;
        }
        public function getStatut(){
			return $this->statut;
        }

		public function setid($id){
			$this->id=$id;
		}
		public function setNom($nom){
			$this->nom=$nom;
		}
		public function setPrenom($prenom){
			$this->prenom;
        }
        public function setEmail($email){
			$this->email=$email;
        }
        public function setMdp($mdp){
			$this->mdp=$mdp;
        }
  		public function setTel($tel){
			$this->tel=$tel;
        }
        public function setAdresse($adresse){
			$this->adresse=$adresse;
        }
        public function setSexe($sexe){
			$this->sexe=$sexe;
        }
        public function setDateNais($date_nais){
			$this->date_nais=$date_nais;
        }
        public function setRole($role){
			$this->role=$role;
        }
        public function setStatut($statut){
			$this->statut=$statut;
        }
}

?>