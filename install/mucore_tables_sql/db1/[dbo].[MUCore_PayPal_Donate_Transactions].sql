CREATE TABLE [dbo].[MUCore_PayPal_Donate_Transactions] (
	[id] [int] IDENTITY (1, 1) NOT NULL ,
	[transaction_id] [varchar] (50) COLLATE Romanian_CI_AS NULL ,
	[amount] [varchar] (50) COLLATE Romanian_CI_AS NULL ,
	[currency] [varchar] (50) COLLATE Romanian_CI_AS NULL ,
	[memb___id] [varchar] (50) COLLATE Romanian_CI_AS NULL ,
	[credits] [int] NULL ,
	[order_date] [int] NULL ,
	[status] [varchar] (50) COLLATE Romanian_CI_AS NULL ,
	[payer_email] [varchar] (50) COLLATE Romanian_CI_AS NULL 
) ON [PRIMARY]