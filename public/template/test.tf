provider "aws" {
  access_key = "AKIAXC44LSQPRHEMNE57"
  secret_key = "S7cfNT86KFoxUFpnT7XyCaTuWLYMv02vQc+v08M1"
  region     = "us-east-2"
}



resource "aws_instance" "us_west_example" {
  ami           = "ami-0fc20dd1da406780b"
  instance_type = "t2.micro"
}