CREATE TABLE [dbo].[MUCore_Change_Passwords] (
	[id] [int] IDENTITY (1, 1) NOT NULL ,
	[password] [varchar] (50) COLLATE Romanian_CI_AS NULL ,
	[email] [varchar] (70) COLLATE Romanian_CI_AS NULL ,
	[expire] [int] NULL ,
	[memb___id] [varchar] (50) COLLATE Romanian_CI_AS NULL ,
	[hash] [varchar] (50) COLLATE Romanian_CI_AS NULL 
) ON [PRIMARY]
