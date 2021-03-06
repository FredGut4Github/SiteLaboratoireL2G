<?php 

function MailHeader()
{
  return '
      <style type="text/css">
          /* CLIENT-SPECIFIC STYLES */
          body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
          table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;} /* Remove spacing between tables in Outlook 2007 and up */
          img{-ms-interpolation-mode: bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */

          /* RESET STYLES */
          img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
          table{border-collapse: collapse !important;}
          body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}

          /* iOS BLUE LINKS */
          a[x-apple-data-detectors] {
              color: inherit !important;
              text-decoration: none !important;
              font-size: inherit !important;
              font-family: inherit !important;
              font-weight: inherit !important;
              line-height: inherit !important;
          }

          /* MOBILE STYLES */
          @media screen and (max-width: 525px) {

              /* ALLOWS FOR FLUID TABLES */
              .wrapper {
                width: 100% !important;
                  max-width: 100% !important;
              }

              /* ADJUSTS LAYOUT OF LOGO IMAGE */
              .logo img {
                margin: 0 auto !important;
              }

              /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
              .mobile-hide {
                display: none !important;
              }

              .img-max {
                max-width: 100% !important;
                width: 100% !important;
                height: auto !important;
              }

              /* FULL-WIDTH TABLES */
              .responsive-table {
                width: 100% !important;
              }

              /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
              .padding {
                padding: 10px 5% 15px 5% !important;
              }

              .padding-meta {
                padding: 30px 5% 0px 5% !important;
                text-align: center;
              }

              .no-padding {
                padding: 0 !important;
              }

              .section-padding {
                padding: 50px 15px 50px 15px !important;
              }

              /* ADJUST BUTTONS ON MOBILE */
              .mobile-button-container {
                  margin: 0 auto;
                  width: 100% !important;
              }

              .mobile-button {
                  padding: 15px !important;
                  border: 0 !important;
                  font-size: 16px !important;
                  display: block !important;
              }

          }

          /* ANDROID CENTER FIX */
          div[style*="margin: 16px 0;"] { margin: 0 !important; }
      </style>
      </head>
      <body style="margin: 0 !important; padding: 0 !important;">

      <!-- HIDDEN PREHEADER TEXT -->
      <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
          Spécialisé dans la prothèse complète amovible, le laboratoire Gutierrez a plus de 50 ans d\'expérience. Il est situé sur Grenoble et livre dans toute la région.
      </div>

      <!-- HEADER -->
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tr>
              <td bgcolor="#333333" align="center">
                  <!--[if (gte mso 9)|(IE)]>
                  <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
                  <tr>
                  <td align="center" valign="top" width="500">
                  <![endif]-->
                  <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="wrapper">
                      <tr>
                          <td align="center" valign="top" style="padding: 15px 0;" class="logo">
                              <a href="http://www.laboratoire-gutierrez.com" target="_blank">
                                  <img alt="Logo Laboratoire Gutierrez" src="http://img15.hostingpics.net/pics/929753logo1.jpg" width="60" height="60" style="display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;" border="0">
                              </a>
                          </td>
                      </tr>
                  </table>
                  <!--[if (gte mso 9)|(IE)]>
                  </td>
                  </tr>
                  </table>
                  <![endif]-->
              </td>
          </tr>
          <tr>
              <td bgcolor="#ffffff" align="center" style="padding: 70px 15px 70px 15px;" class="section-padding">
                  <!--[if (gte mso 9)|(IE)]>
                  <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
                  <tr>
                  <td align="center" valign="top" width="500">
                  <![endif]-->
                  <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
                      <tr>
                          <td>
                              <!-- HERO IMAGE -->
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                      <td class="padding" align="center">
                                          <a href="http://www.laboratoire-gutierrez.com" target="_blank">
                                              <img src="http://img15.hostingpics.net/pics/170401hero1.jpg" width="235" height="123" border="0" alt="Finalisation de l\'inscription" style="display: block; color: #FFFFFF;  font-family: Helvetica, arial, sans-serif; font-size: 16px;" class="img-max">
                                          </a>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
  ';
}



function MailFooter()
{
  return ' <tr>
              <td bgcolor="#E6E9ED" align="center" style="padding: 20px 0px;">
                  <!--[if (gte mso 9)|(IE)]>
                  <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
                  <tr>
                  <td align="center" valign="top" width="500">
                  <![endif]-->
                  <!-- UNSUBSCRIBE COPY -->
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="max-width: 500px;" class="responsive-table">
                      <tr>
                          <td align="center" style="font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;">
                              <a href="http://www.laboratoire-gutierrez.com" target="_blank" style="color: #666666; text-decoration: none;">Visiter le site web</a>
                              <br><br>
                              4 rue Nestor Cornier,<br>
                              38100 Grenoble,<br>
                              04 76 46 92 67

                          </td>
                      </tr>
                  </table>
                  <!--[if (gte mso 9)|(IE)]>
                  </td>
                  </tr>
                  </table>
                  <![endif]-->
              </td>
          </tr>
      </table>';
}

?>