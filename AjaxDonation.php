<?php

include  "../Controller/donorC.php";

include_once '../Controller/organisationC.php';
    //include '../config.php';
$organisationC=new organisationC();
$donor= new donorC();
$liste=$donor->afficherdonations();

if(!isset($_POST['str'])){
    $liste=$donor->afficherdonations();
}
else{
    $liste = $donor->rechercherDonation($_POST['str']);
}

                foreach ($liste as $row) {
                    ?>
                                            <tr>
                                                    <td><?php echo $row['id_donation']; ?></td>
                                                    <td><?php echo $row['Name']; ?></td>
                                                    <td><?php echo $row['Email']; ?></td>
                                                    <td><?php echo $row['Amount']; ?></td>
                                                    <td><?php echo $row['Address']; ?></td>
                                                    <td><?php echo $row['CardName']; ?></td>
                                                    <td><?php echo $row['CreditCardNum']; ?></td>
                                                    <td><?php echo $row['BilingAdress']; ?></td>
                                                    <td><?php echo $row['Cvv']; ?></td>
                                                    <td><?php echo $row['ExpMonth']; ?></td>
                                                    <td><?php echo $row['ExpYear']; ?></td>
                                                    <td><?php echo $row['ZipCode']; ?></td>
                                                    <?php
                                                    $resultaa = $organisationC->afficherOrganisationWithID($row["id_organisation"]);
                                                    foreach($resultaa as $row2){
                                                    ?>
                                                    <td> <?php echo $row2['name']; ?></td>
                                                    <?php
                                                    }
                                                    ?>
                                                    
                                                    
                                                    <td>
                                                        <form method="POST" action="modifierdonation.php">
                                                            <input type="submit" class="btn btn-warning" id="modifier"  value="Modifier" >
                                                            <input type="hidden" value="<?PHP echo $row['id_donation']; ?>" name="id_donation">

                                                        </form>
                                                    <form method="POST" action="supprimerdonations.php">
                                                            <input type="submit" class="btn btn-danger" value= "supprimer">
                                                            <input type="hidden" value="<?PHP echo $row['id_donation']; ?>" name="id_donation">
                                                        
                                                        </form>
                                                    </td>
                                              </tr>

                    <?php
                }

?>