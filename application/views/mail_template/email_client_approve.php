<table cellpadding="0" cellspacing="0" border="0" width="100%" bgcolor="#ffffff">
    <tr>
        <td align="center">
            <table cellpadding="0" cellspacing="0" border="0" width="600" style="border-collapse: collapse;">
                <tr>
                    <td align="center" bgcolor="#ffffff" style="padding: 20px;">
                        <img src="https://yourcompanylogo.com/logo.png" alt="Your Company Logo" style="display: block; max-width: 100%;">
                    </td>
                </tr>
                <tr>
                    <td align="left" bgcolor="#ffffff" style="padding: 20px;">
                        <p style="font-size: 16px; margin: 0;">
                            I authorise BTG International Services Pty Ltd to submit this activity statement to the Commissioner of
                            Taxation for <?php echo $clientdetail['clientname']; ?> / <?php echo $entityname; ?>. I declare that I am authorised to make this declaration, and the
                            information provided to prepare this activity statement is true and correct.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td align="left" bgcolor="#ffffff" style="padding: 20px;">
                        <p style="font-size: 16px; margin: 0;"><?php echo $_SESSION["accountname"].' - '.date('m/d/Y h:i:s', time()); ?></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>