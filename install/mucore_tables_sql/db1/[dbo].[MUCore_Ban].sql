CREATE TABLE [dbo].[MUCore_Ban] (
	[id] [int] IDENTITY (1, 1) NOT NULL ,
	[ban_id] [int] NULL ,
	[type] [int] NULL ,
	[ban_date] [int] NULL ,
	[ban_expire] [int] NULL ,
	[reason] [text] COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[ban_name] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[ban_permanent] [int] NULL ,
	[author] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
