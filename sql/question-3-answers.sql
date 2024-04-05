-- select by id 1:
select * from posts where id = 1;

-- select all posts where title = includes "title 2":
select * from posts where title = 'title 2';

-- select all posts and order by the title column alphabetically:
select * from posts order by title;

-- insert 3 new posts
insert into posts(title, description)
values('insertion 1', 'this is for 3d');

insert into posts(title, description)
values('insertion 2', 'this is for 3d');

insert into posts(title, description)
values('insertion 3', 'this is for 3d');

-- update posts where id = 1, set the title to "new title"
update posts set title = 'new title' where id = 1;

-- delete post where id = 2
delete from posts where id = 2;