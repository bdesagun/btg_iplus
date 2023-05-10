import smtplib
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
import string
import random
import argparse


def send_email_fp(sender,recipient,subject,password,name,message):
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
                                    <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
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
                                                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                                    style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                                    <tr>
                                                        <td style="height:40px;">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:0 35px;">
                                                            <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif;">Hi, {name}
                                                            </h1>
                                                            <p>{message}</p>


                                                            <a href="http://18.215.178.50/btg_iplus/index.php/Login/login_screen"
                                                                style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Login</a>
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
    parser.add_argument('-n',dest='name',type=str,help="Enter Name")
    parser.add_argument('-m',dest='message',type=str,help="Enter Message")
    args = parser.parse_args()
    recipient = args.recipient
    subject = args.subject
    name = args.name
    message = args.message

    print(recipient)
    print(subject)
    print(name)
    print(message)

    sender = "dave.tablante@btgi.com.au"
    # recipient = ["jhunriel.gaspar@btgi.com.au","brian.desagun@btgi.com.au","dave.tablante@btgi.com.au"] 
    # recipient = ["jhunriel.gaspar@btgi.com.au"] 
    # name = "Jhunriel"
    password = "Asd@Qwe#"
    temppass = generate_random_pw()

    send_email_fp(sender,recipient,subject,password,name,message)

    


