<?php
session_start();
    if(isset($_SESSION['completed'])){
         if($_SESSION['completed']=="done"){
        header("Location: ../surveyExit.php");
        }   
    }

    require "classes/DB_Obj.php";

    $DB_Obj=new DB_Obj("TblGCRSurveyData");

    $message ="";
    $COVID_Situation="";
    $ChurchDoBetterJob="";
    $unansweredQuestGod="";
    $UnansweredQuestionsGodExplan="";
    $freqAttendChurch="";
    $IWouldAttendChurchIf="";
    $heardOfGCR="";
    $impressionOfGCR="";
    $wouldLikeContact="";
    //contact info if offered
    $firstName="";
    $lastName="";
    $phone="";
    $email="";
    $preferredContact="";

    $_SESSION['id']=(isset($_SESSION['id'])?$_SESSION['id']:null);

    $survey="<span class=\"condensed\"> We are a new church in Richardson.  We would love to know how you are doing during these uncertain times as our neighbors. Your response to the following 7 questions will help us to do a better job in serving our neighborhood.  Thank you for your participation!
    <br>
    <div id=\"incentiveHighlight\"><p><span class=\"incentiveHead\">Win A FREE Gene Getz Life Essentials Study Bible &amp; &#36;25</span>
    <br><br>
    Please provide your contact info at the end of the questionnaire in order to be included in the drawing for a free Gene Getz Life Essentials Study Bible &amp; a &#36;25 Amazon Gift Card.</p></div>
    <br>
    <hr>
    <div class=\"buttonArray\"><input class=\"srvyBtn\" type=\"submit\" name=\"begin_survey\" value=\"Begin Survey\" title=\"After beginning the questionnaire, to review a question, \nplease use the provided Back button instead of the \nbrowser back  arrow. Thank you.\" /></div>";
    
    //echo "BEGIN SURVEY entered<br>";
    if(isset($_POST['begin_survey'])||isset($_POST['question1_bak'])){
      // echo "BEGIN SURVEY entered: question1_bak=".$_POST['question1_bak']."<br>";
        $COVID_Situation=$_SESSION['COVID_Situation'];
        //1. We're loading a new person into the database; 
        //2. we're presenting question1 textarea; 
        //3. Or we're re-presenting question1 textarea for updates

        if(isset($_POST['begin_survey'])){       
            $DB_Obj->query("INSERT INTO ".$DB_Obj->getTable()." (firstName, lastName, phone, email, preferredContact, COVID_Situation, ChurchDoBetterJob, unansweredQuestGod, UnansweredQuestionsGodExplan, freqAttendChurch, IWouldAttendChurchIf, heardOfGCR, impressionOfGCR, wouldLikeContact) VALUES (:firstName, :lastName, :phone, :email, :preferredContact, :COVID_Situation, :ChurchDoBetterJob, :unansweredQuestGod, :UnansweredQuestionsGodExplan, :freqAttendChurch, :IWouldAttendChurchIf, :heardOfGCR, :impressionOfGCR, :wouldLikeContact)");
        
            $DB_Obj->bind(":firstName",$firstName);
            $DB_Obj->bind(":lastName",$lastName);
            $DB_Obj->bind(":phone",$phone);
            $DB_Obj->bind(":email",$email);
            $DB_Obj->bind(":preferredContact",$preferredContact);
            $DB_Obj->bind(":COVID_Situation",$COVID_Situation);
            $DB_Obj->bind(":ChurchDoBetterJob",$ChurchDoBetterJob);
            $DB_Obj->bind(":unansweredQuestGod",$unansweredQuestGod);
            $DB_Obj->bind(":UnansweredQuestionsGodExplan",$UnansweredQuestionsGodExplan);
            $DB_Obj->bind(":freqAttendChurch",$freqAttendChurch);
            $DB_Obj->bind(":IWouldAttendChurchIf",$IWouldAttendChurchIf);
            $DB_Obj->bind(":heardOfGCR",$heardOfGCR);
            $DB_Obj->bind(":impressionOfGCR",$impressionOfGCR);
            $DB_Obj->bind(":wouldLikeContact",$wouldLikeContact);
        
            $DB_Obj->exe();
            $dID=$DB_Obj->lastInsertId();
            $_SESSION['id']=$dID;
            $message =  "Inserted at ".$dID."<br>";
        }
        //Present question1 in the if case and the Or case
        $survey="1. How has COVID affected you?
        <hr>
        <textarea name=\"COVID_Situation\" placeholder=\"How COVID has affected you?\" maxlength=\"500\">".$COVID_Situation."</textarea>
        <hr>
        <div class=\"buttonArray\"><input class=\"srvyBtn\" type=\"submit\" name=\"question2\" value=\"Continue\" title=\"Continue to question 2.\" /></div>";  
    }

    //2
    if(isset($_POST['question2'])||isset($_POST['question2_bak'])){
        //no prev answer on first nav, get prev answer fro session on back nav
        if(isset($_SESSION['ChurchDoBetterJob'])){
            $ChurchDoBetterJob=$_SESSION['ChurchDoBetterJob'];
        }
            
        //1. We're updating question1 data  
        //2. we're presenting question2 textarea; 
        //3. Or we're re-presenting question2 textarea for updates

        //update on forward navigation, use session on back nav
        if(isset($_POST['question2'])){
            $COVID_Situation=htmlentities($_POST['COVID_Situation']);
            $_SESSION['COVID_Situation']=$COVID_Situation;
            //Update question1 data
            $DB_Obj->query("UPDATE ".$DB_Obj->getTable()." SET `COVID_Situation` = :COVID_Situation WHERE id = :id");
            $DB_Obj->bind(":COVID_Situation", $COVID_Situation);
			$DB_Obj->bind(":id", $_SESSION['id']);
			$DB_Obj->exe();
        }

        $survey="2. How can neighborhood churches better serve you in your daily life?
        <br>
        <textarea name=\"ChurchDoBetterJob\" placeholder=\"How can neighborhood churches better serve you in your daily life?\">".$ChurchDoBetterJob."</textarea>
        <hr>		
        <div class=\"buttonArray\"><input class=\"srvyBtn\" type=\"submit\" name=\"question1_bak\" value=\"Back\" title=\"This is the Back button provided for you to review the \nprevious question. Always use this Back button instead of the \nbrowser back arrow. Thank you.\" />		
        <input class=\"srvyBtn\" type=\"submit\" name=\"question3\" value=\"Continue\" title=\"Continue to question 3\" /></div>";       
    }

    //3
    if(isset($_POST['question3'])||isset($_POST['question3_bak'])){
        
        if(isset($_SESSION['unansweredQuestGod'])){
            $unansweredQuestGod=$_SESSION['unansweredQuestGod'];
        }    
           
        //1. We're updating question2 data 
        //2. we're presenting question3 textarea; 
        //3. Or we're re-presenting question3 textarea for updates

        //update on forward navigation, use session on back nav
        if(isset($_POST['question3'])){
            $ChurchDoBetterJob = htmlentities($_POST['ChurchDoBetterJob']);
            $_SESSION['ChurchDoBetterJob']=$ChurchDoBetterJob;
            //Update question2 data
            $DB_Obj->query("UPDATE ".$DB_Obj->getTable()." SET `ChurchDoBetterJob` = :ChurchDoBetterJob WHERE id = :id");
            $DB_Obj->bind(":ChurchDoBetterJob", $ChurchDoBetterJob);
			$DB_Obj->bind(":id", $_SESSION['id']);
			$DB_Obj->exe();
        }

        $survey="<span class=\"condensed\">3. Do you have unanswered questions about God?</span> <span class=\"Morecondensed\">(If Yes, you will have a chance to explain)</span> 
		<hr>
		<span class=\"parenth\">Yes</span> <input type=\"radio\" name=\"unansweredQuestGod\" value=\"y\" ". ($unansweredQuestGod=='y'? 'checked':'')." ></radio> &nbsp;
		<span class=\"parenth\">No</span> <input type=\"radio\" name=\"unansweredQuestGod\" value=\"n\" ". ($unansweredQuestGod=='n'? 'checked':'')." ></radio> 
		<hr>
		<div class=\"buttonArray\"><input class=\"srvyBtn\" type=\"submit\" name=\"question2_bak\" value=\"Back\" title=\"This is the Back button provided for you to review the \nprevious question. Always use this Back button instead of the \nbrowser back arrow. Thank you.\" />	
		<input class=\"srvyBtn\" type=\"submit\" name=\"question3_choice\" value=\"Continue\" title=\"Continue to question 3 explanation.\" /></div>";       
    }

    //3a) No back navigation to the a) segment of a question. Navigate back to the root question
	if(isset($_POST['question3_choice'])){
        //1. update question3 (unansweredQuestGod)
        //2. control next question using Question3 response
        
        //If there is back navigation to question3, this data, updated in question4 Will be already stored in session  
        if(isset($_SESSION['UnansweredQuestionsGodExplan'])){
            $UnansweredQuestionsGodExplan=$_SESSION['UnansweredQuestionsGodExplan'];            
        }
        
        //Post data from previous question plus update the database 
        $unansweredQuestGod=htmlentities($_POST['unansweredQuestGod']);
        $_SESSION['unansweredQuestGod']=$unansweredQuestGod; 

        $DB_Obj->query("UPDATE ".$DB_Obj->getTable()." SET `unansweredQuestGod` = :unansweredQuestGod WHERE id = :id");
        $DB_Obj->bind(":unansweredQuestGod", $unansweredQuestGod);
        $DB_Obj->bind(":id", $_SESSION['id']);
        $DB_Obj->exe();                    

		if($unansweredQuestGod=='y'){
			$survey="3a. Please explain <br><span class=\"tinyInfo\">(unanswered questions):</span>
			<br>
			<textarea name=\"UnansweredQuestionsGodExplan\" placeholder=\"Unanswered questions about God-Please explain\">".$UnansweredQuestionsGodExplan."</textarea>
			<hr>
			<input class=\"srvyBtn\" type=\"submit\" name=\"question3_bak\" value=\"Back\" This is the Back button provided for you to review the \nprevious question. Always use this Back button instead of the \nbrowser back arrow. Thank you.\" />
			<input class=\"srvyBtn\" type=\"submit\" name=\"question4\" value=\"Continue\" title=\"Continue to question 4.\" />";
		}
		else{
			$survey="Almost done. If you don&#39;t need to review question 3, please continue:
			<hr>
			<div class=\"buttonArray\"><input class=\"srvyBtn\" type=\"submit\" name=\"question3_bak\" value=\"Back\" title=\"This is the Back button provided for you to review the \nprevious question. Always use this Back button instead of the \nbrowser back arrow. Thank you.\" />
			<input class=\"srvyBtn\" type=\"submit\" name=\"question4\" value=\"Continue\" title=\"Continue to question 4.\" /></div>";
		}		
	}

    //4
    if(isset($_POST['question4'])||isset($_POST['question4_bak'])){
        //1. update question3a (UnansweredQuestionsGodExplan)
        //2. Present question4
        //3. Re-Present question4 on backtrack
        if(isset($_SESSION['freqAttendChurch'])){
            $freqAttendChurch=$_SESSION['freqAttendChurch'];
        }  

        //update on forward navigation, use session on back navradio
        if(isset($_POST['question4'])){
            $UnansweredQuestionsGodExplan=htmlentities($_POST['UnansweredQuestionsGodExplan']);
            $_SESSION['UnansweredQuestionsGodExplan']=$UnansweredQuestionsGodExplan;
            
            $DB_Obj->query("UPDATE ".$DB_Obj->getTable()." SET `UnansweredQuestionsGodExplan` = :UnansweredQuestionsGodExplan WHERE id = :id");
            $DB_Obj->bind(":UnansweredQuestionsGodExplan", $UnansweredQuestionsGodExplan);
            $DB_Obj->bind(":id", $_SESSION['id']);
            $DB_Obj->exe();           
        }

        $survey="4. Do you attend church?		
		<hr>
        <table>
		<tr><td style='align:right'><span class=\"parenth\">Regularly</span></td><td style='align:left'><input type=\"radio\" name=\"freqAttendChurch\" value=\"Regularly\" ".($freqAttendChurch=='Regularly'? 'checked':'')." ></radio></td></tr>

		<tr><td style='align:right'><span class=\"parenth\">Occasionally</span></td><td style='align:left'><input type=\"radio\" name=\"freqAttendChurch\" value=\"Occasionally\"".($freqAttendChurch=='Occasionally'? 'checked':'')." ></radio></td></tr>  
		
        <tr><td style='align:right'><span class=\"parenth\">Rarely</span></td><td style='align:left'><input type=\"radio\" name=\"freqAttendChurch\" value=\"Rarely\" ".($freqAttendChurch=='Rarely'? 'checked':'')." ></radio></td></tr> 
       
        <tr><td style='align:right'><span class=\"parenth\">Never</span></td><td style='align:left'><input type=\"radio\" name=\"freqAttendChurch\" value=\"Never\"".($freqAttendChurch=='Never'? 'checked':'')." ></radio></td></tr>
        </table> 
        <hr>
        <div class=\"buttonArray\"><input class=\"srvyBtn\" type=\"submit\" name=\"question3_bak\" value=\"Back\" title=\"This is the Back button provided for you to review the \nprevious question. Always use this Back button instead of the \nbrowser back arrow. Thank you.\" />
		<input class=\"srvyBtn\" type=\"submit\" name=\"question4_choice\" value=\"Continue\" title=\"Continue to question 5, or to a brief followup question.\" /></div>"; 
    }

    //4a) No back navigation to the a) segment of a question. Navigate back to the root question
    if(isset($_POST['question4_choice'])){
        //If there is back navigation to question4, $IWouldAttendChurchIf 
        //Will be already stored in session in Question 5 block 
        if(isset($_SESSION['IWouldAttendChurchIf'])){
            $IWouldAttendChurchIf=$_SESSION['IWouldAttendChurchIf'];
        } 
        // if(isset($_SESSION['freqAttendChurch'])){
        //     $freqAttendChurch=$_SESSION['freqAttendChurch'];
        // } 

        $freqAttendChurch=htmlentities($_POST['freqAttendChurch']);
        $_SESSION['freqAttendChurch']=$freqAttendChurch;

        $DB_Obj->query("UPDATE ".$DB_Obj->getTable()." SET `freqAttendChurch` = :freqAttendChurch WHERE id = :id");
        $DB_Obj->bind(":freqAttendChurch", $freqAttendChurch);
        $DB_Obj->bind(":id", $_SESSION['id']);
        $DB_Obj->exe();                   
        
        if($freqAttendChurch=='Rarely' || $freqAttendChurch=='Never'){
            //update and SESSION $IWouldAttendChurchIf in next question block
			$survey="<span class=\"condensed\">4a. I would attend church if:</span> 
			<br>
			<textarea name=\"IWouldAttendChurchIf\" placeholder=\"I would attend church if...\">". $IWouldAttendChurchIf."</textarea>
			<hr>		
			<div class=\"buttonArray\"><input class=\"srvyBtn\" type=\"submit\" name=\"question4_bak\" value=\"Back\" title=\"This is the Back button provided for you to review the \nprevious question. Always use this Back button instead of the \nbrowser back arrow. Thank you.\" />		
			<input class=\"srvyBtn\" type=\"submit\" name=\"question5\" value=\"Continue\" title=\"Continue to question 5.\" /></div>";
		}
		else{
			$survey="Great! Let&#39;s see how much you&#39;ve heard about GCR and we&#39;re done. Please continue:
			<hr>
			<div class=\"buttonArray\"><input class=\"srvyBtn\" type=\"submit\" name=\"question4_bak\" value=\"Back\" title=\"This is the Back button provided for you to review the \nprevious question. Always use this Back button instead of the \nbrowser back arrow. Thank you.\" />		
			<input class=\"srvyBtn\" type=\"submit\" name=\"question5\" value=\"Continue\" title=\"Continue to a question 5.\" /></div>"; 
		}	
    }

    //5
    if(isset($_POST['question5'])||isset($_POST['question5_bak'])){
        //1. update question4a (IWouldAttendChurchIf)
        //2. Present question5
        //3. Re-Present question5 on backtrack
        if(isset($_SESSION['heardOfGCR'])){
            $heardOfGCR=$_SESSION['heardOfGCR'];
        } 

        //update on forward navigation, use session on back nav
        if(isset($_POST['question5'])){
            $IWouldAttendChurchIf=htmlentities($_POST['IWouldAttendChurchIf']);
            $_SESSION['IWouldAttendChurchIf']=$IWouldAttendChurchIf;
            
            $DB_Obj->query("UPDATE ".$DB_Obj->getTable()." SET `IWouldAttendChurchIf` = :IWouldAttendChurchIf WHERE id = :id");
            $DB_Obj->bind(":IWouldAttendChurchIf", $IWouldAttendChurchIf);
            $DB_Obj->bind(":id", $_SESSION['id']);
            $DB_Obj->exe();                       
        }

        $survey="<span class=\"condensed\">5. Have you ever heard of Grace Communion Richardson?</span>

		<hr>
		<span class=\"parenth\">Yes</span> <input type=\"radio\" name=\"heardOfGCR\" value=\"y\" ".($heardOfGCR=='y'? 'checked':'')."></radio> &nbsp;
		<span class=\"parenth\">No</span> <input type=\"radio\" name=\"heardOfGCR\" value=\"n\" ".($heardOfGCR=='n'? 'checked':'')."></radio> 
		<hr>
		<div class=\"buttonArray\"><input class=\"srvyBtn\" type=\"submit\" name=\"question4_bak\" value=\"Back\" title=\"This is the Back button provided for you to review the \nprevious question. Always use this Back button instead of the \nbrowser back arrow. Thank you.\" />
		<input class=\"srvyBtn\" type=\"submit\" name=\"question5_choice\" value=\"Continue\" title=\"Continue to question 6, or to a brief followup question.\" /></div>";
    }

    //5a No back navigation to the a) segment of a question. Navigate back to the root question
    if(isset($_POST['question5_choice'])){
        //If there is back navigation to question5, $impressionOfGCR 
        //Will be already stored in session in Question 6 block 
        if(isset($_SESSION['impressionOfGCR'])){
            $impressionOfGCR=$_SESSION['impressionOfGCR'];
        }

        $heardOfGCR=htmlentities($_POST['heardOfGCR']);
        $_SESSION['heardOfGCR']=$heardOfGCR;

        $DB_Obj->query("UPDATE ".$DB_Obj->getTable()." SET `heardOfGCR` = :heardOfGCR WHERE id = :id");
        $DB_Obj->bind(":heardOfGCR", $heardOfGCR);
        $DB_Obj->bind(":id", $_SESSION['id']);
        $DB_Obj->exe();              

        if($heardOfGCR=='y'){
			$survey="<span class=\"condensed\">5a. What is your impression of Grace Communion Richardson?</span> 
			<hr>
			<table class=\"condensed\">
			<tr><td>Positive</td><td><input type=\"radio\" name=\"impressionOfGCR\" value=\"Positive\" ".($impressionOfGCR=='Positive'? 'checked':'')." ></radio></td></tr>
			
			<tr><td>Negative</td><td><input type=\"radio\" name=\"impressionOfGCR\" value=\"Negative\" ".($impressionOfGCR=='Negative'? 'checked':'')." ></radio></td></tr>
			
			<tr><td>Neutral</td><td><input type=\"radio\" name=\"impressionOfGCR\" value=\"Neutral\" ".($impressionOfGCR=='Neutral'? 'checked':'')." ></radio></td></tr>
			</table>
			<hr>
			<div class=\"buttonArray\"><input class=\"srvyBtn\" type=\"submit\" name=\"question5_bak\" value=\"Back\" title=\"This is the Back button provided for you to review the \nprevious question. Always use this Back button instead of the \nbrowser back arrow. Thank you.\" />
			<input class=\"srvyBtn\" type=\"submit\" name=\"question6\" value=\"Next\" /></div>";
		}
		else{
			$survey="We intend to make a positive addition to the Richardson community. Please continue:
			<hr>
			<div class=\"buttonArray\"><input class=\"srvyBtn\" type=\"submit\" name=\"question5_bak\" value=\"Back\" title=\"This is the Back button provided for you to review the \nprevious question. Always use this Back button instead of the \nbrowser back arrow. Thank you.\" />
			<input class=\"srvyBtn\" type=\"submit\" name=\"question6\" value=\"Continue\" title=\"Continue.\" /></div>";
		}
    }

    //6
    if(isset($_POST['question6'])||isset($_POST['question6_bak'])){
        //1. update question5a (IWouldAttendChurchIf)
        //2. Present question6
        //3. Re-Present question6 on backtrack
        if(isset($_SESSION['wouldLikeContact'])){
            $wouldLikeContact=$_SESSION['wouldLikeContact'];
        }

        if(isset($_POST['question6_bak'])){
            
            if(isset($_POST['firstName'])){
                $_SESSION['firstName']=htmlentities($_POST['firstName']);
            }
            if(isset($_POST['lastName'])){
                $_SESSION['lastName']=htmlentities($_POST['lastName']);
            }
            if(isset($_POST['phone'])){
                $_SESSION['phone']=htmlentities($_POST['phone']);
            }
            if(isset($_POST['email'])){
                $_SESSION['email']=htmlentities($_POST['email']);
            }
            if(isset($_POST['preferredContact'])){
                $_SESSION['preferredContact']=htmlentities($_POST['preferredContact']);
            }

        }

        //update on forward navigation, use session on back nav
        if(isset($_POST['question6'])){
            $impressionOfGCR=htmlentities($_POST['impressionOfGCR']);
            $_SESSION['impressionOfGCR']=$impressionOfGCR;
            
            $DB_Obj->query("UPDATE ".$DB_Obj->getTable()." SET `impressionOfGCR` = :impressionOfGCR WHERE id = :id");
            $DB_Obj->bind(":impressionOfGCR", $impressionOfGCR);
            $DB_Obj->bind(":id", $_SESSION['id']);
            $DB_Obj->exe();                       
        }

        $survey="<span class=\"Morecondensed\">Thank you for helping us get to know our new neighborhood better. If you have needs concerns or questions, please call us at (830) 308-7284 or visit: gcrichardson.org/contact/</span>
		<hr>
        <div id=\"incentiveHighlight\"><p><span class=\"incentiveHead\">Win A FREE Gene Getz Life Essentials Study Bible &amp; &#36;25</span>
        <br><br>
        On the next page, please provide minimum contact info in order to be included in the drawing (and in case you should win the drawing) for a free Gene Getz Life Essentials Study Bible &amp; a &#36;25 Amazon Gift Card</p></div>
		
		<br><br>
		<input type=\"checkbox\" name=\"wouldLikeContact\" value=\"contact\" ".($wouldLikeContact=='contact'? 'checked':'')." title=\"Your contact information will be used in the event that you win the drawing. \nChecking here expresses that you also want someone from GCR to contact you \nregarding questions concerns or needs.\"></checkbox> <span class=\"smallerInfo2\">Check here if you would like someone from Grace Communion Richardson to contact you regarding needs, concerns or questions.</span> 
		<hr>
		<div class=\"buttonArray\"><input class=\"srvyBtn\" type=\"submit\" name=\"question5_bak\" value=\"Back\" title=\"This is the Back button provided for you to review the \nprevious question. Always use this Back button instead of the \nbrowser back arrow. Thank you.\" />
		<input class=\"srvyBtn\" type=\"submit\" name=\"question6_choice\" value=\"Continue\" title=\"Continue to a brief followup question.\" /></div>";
    }

    //6a No back navigation to the a) segment of a question. Navigate back to the root question
    if(isset($_POST['question6_choice'])){
        
        //Session saved if back button hit two question6
        if(isset($_SESSION['firstName'])){
            $firstName=$_SESSION['firstName'];
        }
        if(isset($_SESSION['lastName'])){
            $lastName=$_SESSION['lastName'];
        }
        if(isset($_SESSION['phone'])){
            $phone=$_SESSION['phone'];
        }
        if(isset($_SESSION['email'])){
            $email=$_SESSION['email'];
        }
        if(isset($_SESSION['preferredContact'])){
            $preferredContact=$_SESSION['preferredContact'];
        }

        $wouldLikeContact=htmlentities($_POST['wouldLikeContact']);
        $_SESSION['wouldLikeContact']=$wouldLikeContact;

        $DB_Obj->query("UPDATE ".$DB_Obj->getTable()." SET `wouldLikeContact` = :wouldLikeContact WHERE id = :id");
        $DB_Obj->bind(":wouldLikeContact", $wouldLikeContact);
        $DB_Obj->bind(":id", $_SESSION['id']);
        $DB_Obj->exe();                      

        $survey="<span class=\"condensed\">Please provide yor contact information. 
        <br>
        <table class=\"contact\">
            <tr>
                <td>Name:</td>
                <td><input type=\"textbox\" name=\"firstName\" placeholder=\"First Name\" value=\"".$firstName."\" /></td><td style=\"padding:2px; margin:2;\">
                <input type=\"textbox\" name=\"lastName\" placeholder=\"Last Name\" value=\"".$lastName."\" /></td>
            </tr>
            <tr>
                <td>Phone:</td>
                <td colspan=\"2\"><input type=\"textbox\" name=\"phone\" placeholder=\"###-###-####\" value=\"". $phone."\" /></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td colspan=\"2\"><input type=\"email\" size=\"35\"name=\"email\" placeholder=\"usrname@provider.com\" value=\"".$email."\" /></td>
            </tr>
        </table>
        <hr>
        Preferred contact method(s):
        <br>
        <input type=\"checkbox\" name=\"preferredContact\" value=\"Phone\" ".($preferredContact=='Phone'? 'checked':'')." >
        <span class=\"checkboxtext\">Phone</span></checkbox>&nbsp;
        
        <input type=\"checkbox\" name=\"preferredContact\" value=\"Text\" ".($preferredContact=='Text'? 'checked':'')." >
        <span class=\"checkboxtext\">Text</span></checkbox>&nbsp;

        <input type=\"checkbox\" name=\"preferredContact\" value=\"Email\" ".($preferredContact=='Email'? 'checked':'')." >
        <span class=\"checkboxtext\">Email</span></checkbox>
        <hr>
        <div class=\"buttonArray\"><input class=\"srvyBtn\" type=\"submit\" name=\"question6_bak\" value=\"Back\" title=\"This is the Back button provided for you to review the \nprevious question. Always use this Back button instead of the \nbrowser back arrow. Thank you.\" />
        <input class=\"srvyBtn\" type=\"submit\" name=\"question7\" value=\"Finish\" title=\"Submit questionnaire.\" /></div>";
	}

    //7
    if(isset($_POST['question7'])){
        $firstName=htmlentities($_POST['firstName']);
        $lastName=htmlentities($_POST['lastName']);
        $phone=htmlentities($_POST['phone']);
        $email=htmlentities($_POST['email']);
        $preferredContact=htmlentities($_POST['preferredContact']);
        
        $DB_Obj->query("UPDATE ".$DB_Obj->getTable()." SET `firstName` = :firstName, `lastName` = :lastName, `phone` = :phone, `email` = :email, `preferredContact` = :preferredContact WHERE id = :id");
        $DB_Obj->bind(":firstName", $firstName);
        $DB_Obj->bind(":lastName", $lastName);
        $DB_Obj->bind(":phone", $phone);
        $DB_Obj->bind(":email", $email);
        $DB_Obj->bind(":preferredContact", $preferredContact);
        $DB_Obj->bind(":id", $_SESSION['id']);
        $DB_Obj->exe();    
        
        unset($_POST);
        $_SESSION['completed']="done";

        include_once("surveyExit.php");
        exit;
 
        //exit message in case an issue with relocate
        $survey="<span class=\"condensed\">This completes the questionnaire. Thank you so much for your participation!</span>
		<br><br>
		<div id=\"info\">
        <p>
            <a href=\"https://gcrichardson.org\" title=\"Grace Communion Richardson\">Grace Communion Richardson</a> 
            <br>201 N. Plano Road, Richardson, TX 75081 
            <br>(830) 308-7284
            <br>Church Services are on Sundays at 11:00 AM
        </p>
	</div>";
    }
?>
