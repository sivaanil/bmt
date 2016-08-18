<?PHP

require_once "Imap.php";

$mailbox = 'imap.gmail.com:993';
$username = 'saichandana52.mca@gmail.com';
$password = 'SAILAKSHMI';
$encryption = 'ssl'; // or ssl or ''

// open connection
$imap = new Imap($mailbox, $username, $password, $encryption);

// stop on error
if($imap->isConnected()===false)
    die($imap->getError());

// get all folders as array of strings
$folders = $imap->getFolders();
foreach($folders as $folder)
   echo $folder."<br/>";
//exit;
// select folder Inbox
$imap->selectFolder('Personal');
$emails = $imap->getMessages();
// count messages in current folder
//$overallMessages = $imap->countMessages();
echo "<pre>";
var_dump($emails);
exit;
$unreadMessages = $imap->countUnreadMessages();

// fetch all messages in the current folder
$emails = $imap->getMessages();


// add new folder for archive
$imap->addFolder('archive');

// move the first email to archive
$imap->moveMessage($emails[0]['id'], 'archive');

// delete second message
$imap->deleteMessage($emails[1]['id']);