variable "app" {}
variable "nic1" {}
variable "nic2" {}
variable "vmname" {}
variable "emailid" {}


provider "openstack" {
  user_name   = "admin"
  tenant_name = "cpns"
  password    = "ayZma3wpahjHWgpjBRQypFUYK"
  auth_url    = "http://10.85.49.148:5000/v2.0"
}

data "openstack_blockstorage_volume_v2" "volume_1" {
  
}


