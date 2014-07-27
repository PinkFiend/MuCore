CREATE TABLE [dbo].[MUCore_temp_passwords] (
	[id] [int] IDENTITY (1, 1) NOT NULL ,
	[memb_guid] [int] NULL ,
	[expire] [int] NULL ,
	[hash] [char] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[memb___id] [varchar] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
