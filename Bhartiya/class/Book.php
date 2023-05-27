<?php 
require_once('../database/Database.php');
require_once('../interface/iBook.php');
class Book extends Database implements iBook{

	public function getAllBook()
	{
		$sql = "SELECT *
				FROM booked
				GROUP BY book_tracker;
		";
		return $this->getRows($sql);
	}

	public function deleteBook($tracker)
	{
		$sql = "DELETE FROM booked WHERE book_tracker = ?;";
		
		return $this->deleteRow($sql, [$tracker]);
	}

	public function getBookBy($tracker)
	{
		$sql = "SELECT * FROM booked WHERE book_tracker = ? LIMIT 1";
		return $this->getRow($sql, [$tracker]);
	}

	public function getPassengers($tracker)
	{
		$sql = "SELECT *
				FROM booked b 
				INNER JOIN accomodation a 
				ON b.acc_id = a.acc_id
				WHERE b.book_tracker = ?;
		";
		return $this->getRows($sql, [$tracker]);
	}
	public function selectBook($book_id)
	{
		$sql = "SELECT *
				FROM booked b
				INNER JOIN accomodation a 
				ON b.acc_id = a.acc_id 
				INNER JOIN origin o 
				ON b.origin_id = o.origin_id
				INNER JOIN destination d 
				ON b.dest_id = d.dest_id 
				WHERE b.book_id = ?;
		";
		return $this->getRow($sql, [$book_id]);
	}

	public function deleteBookByID($bid)
	{
		$sql = "DELETE 
				FROM booked 
				WHERE book_id = ?
		";
		return $this->deleteRow($sql, [$bid]);
	}
}

$book = new Book();