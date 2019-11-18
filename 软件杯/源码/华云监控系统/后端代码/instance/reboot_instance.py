from chinac_way_v3.core.profile.profile import Profile
from chinac_way_v3.core.client import Client
from chinac_way_v3.ecs.v10.reboot_instance import RebootInstance
import json
from web.save_log import save_log

def Reboot_Instance(region_id, access_key_id, access_secret,id):
    profile = Profile(region_id,access_key_id,access_secret)
    client = Client(profile)
    request = RebootInstance()
    request.set_method('GET')
    request.set_id(id)
    # 调用旧版request.set_old_version()
    # 调用v2新版request.set_v2_version(),默认是新版
    response = client.get_response(request)
    dict = json.loads(response)
    str=json.dumps(dict)

    Action=request.get_action()
    f = open('./action.log', 'w')  # 若是'wb'就表示写二进制文件
    f.write(str,Action)
    f.close()
    return dict