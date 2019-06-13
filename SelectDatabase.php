<?php
include "ConnectDB.php";

//select all jobs
    $sql = "SELECT \n"
    . "jobs_detail.jobs_id,\n"
    . "jobs_detail.jobs_head,\n"
    . "jobs_detail.jobs_data,\n"
    . "jobs_edu.edu_name,\n"
    . "jobs_detail.jobs_contact, \n"
    . "jobs_detail.jobs_salary, \n"
    . "employment.employment_name, \n"
    . "jobs_detail.jobs_date,\n"
    . "jobs_exp.exp_year,\n"
    . "jobs_detail.jobs_date,\n"
    . "jobs_class.jobs_class, \n"
    . "jobs_detail.image \n"
    . "FROM jobs_detail \n"
    . "INNER JOIN jobs_edu ON jobs_detail.jobs_edu = jobs_edu.edu_id \n"
    . "INNER JOIN employment ON jobs_detail.employment_type = employment.employment_id \n"
    . "INNER JOIN jobs_exp ON jobs_detail.jobs_exp = jobs_exp.exp_id\n"
    . "INNER JOIN jobs_class ON jobs_detail.jobs_class = jobs_class.jobs_class_id \n"
    . "INNER JOIN user ON jobs_detail.user_id = user.user_id\n"
    . "\n";
    $queryjobs = mysqli_query($connect,$sql); 


 //select Hot jobs
 $hot = "SELECT \n"
 . "jobs_detail.jobs_id,\n"
 . "jobs_detail.jobs_head,\n"
 . "jobs_detail.jobs_data,\n"
 . "jobs_edu.edu_name,\n"
 . "jobs_detail.jobs_contact, \n"
 . "jobs_detail.jobs_salary, \n"
 . "employment.employment_name, \n"
 . "counter.visit, \n"
 . "jobs_detail.jobs_date,\n"
 . "jobs_exp.exp_year,\n"
 . "jobs_detail.jobs_date,\n"
 . "jobs_class.jobs_class, \n"
 . "jobs_detail.image \n"
 . "FROM jobs_detail \n"
 . "INNER JOIN jobs_edu ON jobs_detail.jobs_edu = jobs_edu.edu_id \n"
 . "INNER JOIN employment ON jobs_detail.employment_type = employment.employment_id \n"
 . "INNER JOIN jobs_exp ON jobs_detail.jobs_exp = jobs_exp.exp_id\n"
 . "INNER JOIN jobs_class ON jobs_detail.jobs_class = jobs_class.jobs_class_id \n"
 . "INNER JOIN user ON jobs_detail.user_id = user.user_id\n"
 . "INNER JOIN counter ON jobs_detail.jobs_id = counter.jobs_id\n"
 . "\n";

 
//category
$All = "SELECT COUNT(jobs_id) as jobs_id From jobs_detail";
$SelectClass = "SELECT jobs_class from jobs_class ORDER BY jobs_class";
    


//Select Noti
$Noti = "Select notification.noti_id,notification.user_id,notification.date,user.username,jobs_detail.jobs_id,jobs_detail.user_id as user_Host From notification \n"
        ."INNER JOIN user ON notification.user_id = user.user_id \n"
        ."INNER JOIN jobs_detail ON notification.jobs_id = jobs_detail.jobs_id"
        ."\n";


//Select Confirm
$accept =  "Select confirm.confirm_id,confirm.user_host,confirm.user_regis,confirm.date,confirm.jobs_id,user.username From confirm \n"
            ."INNER JOIN user ON confirm.user_host = user.user_id \n"
            ."\n";


//select
    $SelectPersonalData = "SELECT * FROM `personal_data` WHERE user_id = '$row_userID'";
    $SelectResume = "SELECT * FROM `resume` WHERE user_id = '$row_userID'";
    $SelectEdu = "SELECT resume.education,jobs_edu.edu_name FROM `resume` INNER JOIN jobs_edu ON resume.education = jobs_edu.edu_id WHERE user_id = '$row_userID'";
    $SelectExp = "SELECT resume.jobs_exp,jobs_exp.exp_year FROM `resume` Left JOIN jobs_exp ON resume.jobs_exp = jobs_exp.exp_id WHERE user_id = '$row_userID'";
    $reciveTargetJob = "SELECT jobs_class.jobs_class FROM `resume` Left JOIN jobs_class ON resume.target_jobs = jobs_class.jobs_class_id WHERE user_id = '$row_userID'";
   


//query
    $queryPersonal = mysqli_query($connect,$SelectPersonalData);    
    $queryResume = mysqli_query($connect,$SelectResume);
    $queryEdu = mysqli_query($connect,$SelectEdu);
    $queryExp = mysqli_query($connect,$SelectExp);
    $queryTargetJob = mysqli_query($connect,$reciveTargetJob);


//fetch
    $Personal = mysqli_fetch_assoc($queryPersonal);
    $Resume = mysqli_fetch_assoc($queryResume);
    $Edu = mysqli_fetch_assoc($queryEdu);
    $Exp= mysqli_fetch_assoc($queryExp);
    $targetJob = mysqli_fetch_assoc($queryTargetJob);



//reciveResume
    $recivePersonalData = "SELECT * FROM `personal_data`\n";
    $reciveResume = "SELECT * FROM `resume`\n";
    $reciveEdu = "SELECT resume.education,jobs_edu.edu_name FROM `resume` INNER JOIN jobs_edu ON resume.education = jobs_edu.edu_id \n";
    $reciveExp = "SELECT resume.jobs_exp,jobs_exp.exp_year FROM `resume` Left JOIN jobs_exp ON resume.jobs_exp = jobs_exp.exp_id \n";
    
