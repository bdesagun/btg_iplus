<table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td align="center" valign="top" style="padding: 20px 0;">
            <img src="https://example.com/logo.png" alt="Company Logo" width="150">
        </td>
    </tr>
    <tr>
        <td align="center" valign="top" style="padding: 40px 20px;">
            <h1 style="font-size: 36px; margin: 0; color: #333;">To verify your email, please click the link below.</h1>
            <h1 style="font-size: 36px; margin: 0; color: #333;">
                <a href="<?php echo base_url(); ?>index.php/verify/code_verification?emailcode=<?php echo $emailcode; ?>">
                    <?php echo base_url(); ?>index.php/verify/code_verification?emailcode=<?php echo $emailcode; ?>
                </a>
            </h1>
        </td>
    </tr>
</table>