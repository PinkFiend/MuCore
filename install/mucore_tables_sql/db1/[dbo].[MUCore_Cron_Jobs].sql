CREATE TABLE [dbo].[MUCore_Cron_Jobs] (
	[id] [int] IDENTITY (1, 1) NOT NULL ,
	[name] [text] COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[cron_id] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[next_cron] [int] NULL ,
	[cron_time_set] [int] NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
