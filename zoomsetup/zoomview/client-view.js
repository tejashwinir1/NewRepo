ZoomMtg.setZoomJSLib('https://source.zoom.us/2.13.0/lib', '/av')

ZoomMtg.preLoadWasm()
ZoomMtg.prepareWebSDK()
// loads language files, also passes any error messages to the ui
ZoomMtg.i18n.load('en-US')
ZoomMtg.i18n.reload('en-US')

var authEndpoint = ''
var sdkKey = '2XG7RcunQGW3-KX5pxUIXQ'
var apiSecret = 'bPvWX8DT6kg9S1KJQc8DQCDJN2vCVMiBAMYw'
var meetingNumber = '85061213022	'
var passWord = ''
var role = 1
var userName = 'JavaScript'
var userEmail = 'dreamvishnu@gmail.com'
var registrantToken = '8sYrK6maSteGeBmZWWnPGw'
var joinUrl = 'https://us06web.zoom.us/j/85061213022'; 
var url = new URL(joinUrl);
var registrantToken = 'tZEtceiqrzgqGNaqkl8vsr7FiWX_oJ7NPOQ6';
console.log('registrantToken',registrantToken);
var zakToken = 'eyJ0eXAiOiJKV1QiLCJzdiI6IjAwMDAwMSIsInptX3NrbSI6InptX28ybSIsImFsZyI6IkhTMjU2In0.eyJhdWQiOiJjbGllbnRzbSIsInVpZCI6IkV0LTJFT0pkVHd1LXhNTDZLMlo3NlEiLCJpc3MiOiJ3ZWIiLCJzayI6IjAiLCJzdHkiOjEwMCwid2NkIjoidXMwNiIsImNsdCI6MCwibW51bSI6Ijg1MDYxMjEzMDIyIiwiZXhwIjoxNjg1ODA1NTcyLCJpYXQiOjE2ODU3OTgzNzIsImFpZCI6IlFOaDJaaU9qU3UtMWRGZ0FBdmhmWkEiLCJjaWQiOiIifQ.I5VFEg9jMHQuhVq_GRLaMY0OVpVp1NTaD_zN-'
var leaveUrl = 'https://zoom.us'

/*function getSignature() {
  fetch(authEndpoint, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      meetingNumber: meetingNumber,
      role: role
    })
  }).then((response) => {
    return response.json()
  }).then((data) => {
    console.log(data)
    startMeeting(data.signature)
  }).catch((error) => {
  	console.log(error)
  })
}*/

var signature = ZoomMtg.generateSDKSignature({
            meetingNumber: meetingNumber,
            sdkKey: sdkKey,
            sdkSecret: apiSecret,
            role: 0,
            success: function(res) {
				
                console.log('SIGNATURE',res.result);
            },
			error: (error) => {
				  console.log(error)
				}
        });

function startMeeting() {

  document.getElementById('zmmtg-root').style.display = 'block'

  ZoomMtg.init({
    leaveUrl: leaveUrl,
    success: (success) => {
      ZoomMtg.join({
        signature: signature,
        sdkKey: sdkKey,
        meetingNumber: meetingNumber,
		tk:registrantToken,
		passWord:'pass123',
        userName: userName,
        userEmail: userEmail,
        zak: zakToken,
        success: (success) => {
          console.log('JOIN SUCCESS',success)
        },
        error: (error) => {
          console.log('JOIN FAIL',error)
        },
      })
    },
    error: (error) => {
      console.log(error)
    }
  })
}
