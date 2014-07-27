CREATE TABLE [dbo].[MUCore_Shop_Logs](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[memb___id] [nvarchar](50) COLLATE Polish_CI_AS NULL,
	[content] [text] COLLATE Polish_CI_AS NULL,
	[date_time] [int] NULL,
	[item_serial] [text] COLLATE Polish_CI_AS NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]