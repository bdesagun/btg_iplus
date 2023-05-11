import smtplib
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
import string
import random
import argparse


def send_email_fp(sender,recipient,subject,password,clientname,entityname,accountname,loginlink):
    try:
        msg = MIMEMultipart('alternative')

        msg['From'] = sender
        msg['To'] = recipient
        msg['Subject'] = subject

#         body_text = "Hi this is test email"
        body_html = f'''
                    <!doctype html>
                    <html lang="en-US">

                    <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
                        <!--100% body table-->
                        <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
                            style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif;">
                            <tr>
                                <td>
                                    <table style="background-color: #f2f3f8; max-width:800px;  margin:0 auto;" width="100%" border="0"
                                        align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="height:80px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:center;">
                                              <a href="https://btgi.com.au" title="logo" target="_blank">
                                                <img width="100" src="https://btgi.com.au/wp-content/uploads/2022/01/Btg-Logo-High-Resolution-03.png" title="logo" alt="logo">
                                              </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height:20px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table width="95%" border="0" cellpadding="0" cellspacing="0"
                                                    style="max-width:800px;background:#fff; border-radius:3px;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                                    <tr>
                                                        <td style="height:40px;">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:0 35px;">
															<p style="line-height: 30px">
																I authorise BTG International Services Pty Ltd to submit this activity statement to the Commissioner of
																Taxation for <b>{clientname} / {entityname}</b>. I declare that I am authorised to make this declaration, and the
																information provided to prepare this activity statement is true and correct.
															</p>
															<br>
															<p><b>{accountname}</b></p>
															<center>
                                                            <a href="{loginlink}"
                                                                style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Login</a>
															</center>
														</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="height:40px;">&nbsp;</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        <tr>
                                            <td style="height:20px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:center;">
                                                <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>www.btgi.com.au</strong></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height:80px;">&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <!--/100% body table-->
                    </body>

                    </html>'''

#         part1 = MIMEText(body_text, 'plain')
        part2 = MIMEText(body_html, 'html')

#         msg.attach(part1)
        msg.attach(part2)

        mail = smtplib.SMTP("smtp.outlook.office365.com", 587, timeout=20)

        # if tls = True
        mail.starttls()
        mail.login(sender, password)
        mail.sendmail(sender, recipient, msg.as_string())
        mail.quit()

    except Exception as e:
        raise e
    
def generate_random_pw(length: int=16) -> str:
    """
    Generates a random password.
    Parameters
    ----------
    length: int
        The length of the returned password.
    Returns
    -------
    str
        The randomly generated password.
    """
    letters = string.ascii_letters + string.digits
    return ''.join(random.choice(letters) for i in range(length)).replace(' ','')

if __name__ == '__main__':
    
    parser = argparse.ArgumentParser(description='Send Email')
    parser.add_argument('-r',dest='recipient',type=str,help="Enter email of Recipient")
    parser.add_argument('-s',dest='subject',type=str,help="Enter Subject")
    parser.add_argument('-cn',dest='clientname',type=str,help="Enter Client name")
    parser.add_argument('-en',dest='entityname',type=str,help="Enter Entity name")
    parser.add_argument('-an',dest='accountname',type=str,help="Enter Account name")
    parser.add_argument('-l',dest='loginlink',type=str,help="Enter Password")
    args = parser.parse_args()
    recipient = args.recipient
    subject = args.subject
    clientname = args.clientname
    entityname = args.entityname
    accountname = args.accountname
    loginlink = args.loginlink

    print(recipient)
    print(subject)
    print(clientname)
    print(entityname)
    print(accountname)

    sender = "dave.tablante@btgi.com.au"
    # recipient = ["jhunriel.gaspar@btgi.com.au","brian.desagun@btgi.com.au","dave.tablante@btgi.com.au"] 
    # recipient = ["jhunriel.gaspar@btgi.com.au"] 
    # name = "Jhunriel"
    password = "Asd@Qwe#"
    temppass = generate_random_pw()

    send_email_fp(sender,recipient,subject,password,clientname,entityname,accountname,loginlink)

    


