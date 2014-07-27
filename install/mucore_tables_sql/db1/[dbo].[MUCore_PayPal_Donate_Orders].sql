CREATE TABLE [dbo].[MUCore_PayPal_Donate_Orders] (
	[id] [int] IDENTITY (1, 1) NOT NULL ,
	[donate_id] [varchar] (50) COLLATE Romanian_CI_AS NULL ,
	[amount] [varchar] (50) COLLATE Romanian_CI_AS NULL ,
	[currency] [varchar] (50) COLLATE Romanian_CI_AS NULL ,
	[credits] [int] NULL ,
	[memb___id] [varchar] (50) COLLATE Romanian_CI_AS NULL ,
	[hash] [varchar] (50) COLLATE Romanian_CI_AS NULL 
) ON [PRIMARY]