package model

import ("gorm.io/gorm")

type Category struct {
	gorm.Model
	Name string `gorm:"type:varchar(255)" json:"name"`
}
