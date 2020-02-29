

provider "openstack" {
  user_name   = "admin"
  tenant_name = "cpns"
  password    = "ayZma3wpahjHWgpjBRQypFUYK"
  auth_url    = "http://10.85.49.148:5000/v2.0"
}

data "openstack_images_image_v2" "linux" {
  
}


