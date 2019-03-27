<?php
return  [	
		//应用ID,您的APPID。
		'app_id' => "2016092200571854",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCuqnjyPngYuQLzt/hfp4/RMGd27/w6Mhgf6n0ZCAp0BXFwYncdhzI0vQconPcyAFQR7EFFGBxpucOK/woBdvaQZx5LCuD00bBRUiNB0XFcsEC1JyI98gHWw1GtvtXFiZmaELbO1eQkzGVgP3Xa5EOFGTKE+sEqTW9VJ2GkRyzc0P4Vm6g1kK2taBiL7cmCQXqfAvie4Dm4ukYHykGqrl1FzIv20I9LeSxbC0/6OqwYPtbHzkWl3ohSjUBNdHKmQdF5hFcpNMRxfCkgtdzLf132O8ageASEd8pdhzz32jKmrnwdqgjGuW64RtOfYoa/wAz44GxAZEayufBQ1LrTw6SNAgMBAAECggEBAJlSGwjJvTI2dVjqzKNqutut2aSV1JphDrw1YcpvPH3LqWA1jsnkuzWAGKCV6IeDskhpUoIMQCSuY+/HIElY2+a2HelRi1ZcGqHHsBs+dnweWy6pQ22M2gBjQ3d4ZL4ZozOSKGY3ayTCJtrt2c5jQMG89JO2aYlwn6HoB9XkhITvnEro+bfKsPH35GruqW0V/ubN92z/ZCoGIROB+/pRzwbn06zQvFrFMk86RG+fTJba6eERJOi/HOob1MDtXvkuZIcRqqU3BUEXo32PhbrGqoYGov2X1e7SYKlVZRA7ZdfQcAKTamqcxE4qYfDijfQg8e7af+J5YruYPVI7bNatrSECgYEA15k0xZA+hCGl+Bm5+44/utcB+GlcE3XanE8+2y+mQrpEWNspQCDlYpMZ98idGN5QW4QyxEq3A+UjGJ8Br9W1lERIU8TqRq6ULsaZr/WWIh/4L3j4pQybOKUleapQlS6+hE3wz2GfkkqI0r02JN6HnFPPX+f0w+UMqKvWSi+g1PcCgYEAz2WhSNCFESy877JyXrjOd6JaXWWU4FYfhANcux5NqQNnC2Sva7zQv52F0Oe6kgYr2kxsPMgt74rjYNV9+bdj6hfWOZ2ZgywMBTjz99EfAHiGH1dd9uGXploM5kXPb3V9FmDio/RlFrqAc1K4gmNzS6hAOVJgv9XaBmoJcc59JZsCgYBEsVLIE8JndRUdbIz+Yn9Zt4GwNVmZ9bX2kaU0TwVJQ3HdYc7N2O1dMANZGHk9YC/4SLGoKyoOuqYpBRiTfqMBH5Rv5FDEvoEGOk7janswWkFIVuHaLJ8UOEItdp+AOMmI/BBa8v7VrJvVkWW7748DtwxewVgSRlt3LnDzaCN1VwKBgDJ/R07oXo34+6PNKiXAD513bVMySZZ5wcCt5OU2kqglSPCwOjocRiNxokRkN7wYPpMvamc+QlkB0y0frkWgDnbQCPwMUHVswxx+aoCbbVX7AoUdC6bx9K+vW1ayBrjXvXY2btiGyBpJnL73lC9DMa5pMAIE+cObuTM4nEYWhcgjAoGAbPqzEk2VvJGd4CFSMf5IOR2Kh06+qi3JLIW1AxbFVxANfVr5UB4gmwsGXbiRwLsN4wPK1O852GvrUP1A7QpQ5fM+puB1nkUwUMHaQxDs+BxGJA6kyG0CUr8CCbbRVYF3uFTpzkl7fUxCMnlTE29vSB5rQpFriPvbteHEXtdy99o=",
		
		//异步通知地址
		'notify_url' => "http://www.chaorengou.com/notify",
		
		//同步跳转
		'return_url' => "http://www.chaorengou.com/returns",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEArqp48j54GLkC87f4X6eP0TBndu/8OjIYH+p9GQgKdAVxcGJ3HYcyNL0HKJz3MgBUEexBRRgcabnDiv8KAXb2kGceSwrg9NGwUVIjQdFxXLBAtSciPfIB1sNRrb7VxYmZmhC2ztXkJMxlYD912uRDhRkyhPrBKk1vVSdhpEcs3ND+FZuoNZCtrWgYi+3JgkF6nwL4nuA5uLpGB8pBqq5dRcyL9tCPS3ksWwtP+jqsGD7Wx85Fpd6IUo1ATXRypkHReYRXKTTEcXwpILXcy39d9jvGoHgEhHfKXYc899oypq58HaoIxrluuEbTn2KGv8AM+OBsQGRGsrnwUNS608OkjQIDAQAB",

		//标识沙箱环境
		"mode"=>'dev'
		
	
];