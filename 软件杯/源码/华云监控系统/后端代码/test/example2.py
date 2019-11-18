from instance.reboot_instance import Reboot_Instance
from instance.describe_instances import Describe_Instance
region_id='cn-huaian'
access_key_id='32a0c827d06443d79fd10295367f7ab4'
access_secret='b3e35170b725442e9a45e9b1aed2b088'
id='i-q66rj5bmd648j'
jsonData = Describe_Instance(region_id, access_key_id, access_secret)
print(jsonData)

data=Reboot_Instance(region_id, access_key_id, access_secret,id)
print(data)

