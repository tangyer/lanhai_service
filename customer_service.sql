/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : customer_service

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 29/12/2024 10:57:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for lh_active_code
-- ----------------------------
DROP TABLE IF EXISTS `lh_active_code`;
CREATE TABLE `lh_active_code`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL DEFAULT 0 COMMENT '商户ID',
  `active_code` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '激活码',
  `active_code_group_id` int(11) NOT NULL DEFAULT 0 COMMENT '所属分组',
  `port_num` smallint(5) NOT NULL COMMENT '分配端口',
  `expire_time` int(11) NOT NULL DEFAULT 0 COMMENT '失效时间',
  `clean_time` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '清零时间',
  `platform` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '使用平台',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '说明',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态',
  `create_user` int(11) NOT NULL DEFAULT 0 COMMENT '创建人',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lh_active_code
-- ----------------------------
INSERT INTO `lh_active_code` VALUES (1, 1, '88888', 1, 10, 1734630000, '', 'whatsapp', '这是备注', '这是说明', 1, 0, 1734449916, 0);
INSERT INTO `lh_active_code` VALUES (10, 2, 'EFHVNGPGQU', 3, 10, 1735315200, '10:00:00', 'whatsapp,telegram', '111', '22222', 1, 1, 1735037298, 0);
INSERT INTO `lh_active_code` VALUES (11, 2, 'CTGZBD7TUQ', 3, 8, 1735574400, '03:00:00', 'whatsapp,telegram', 'rrrr', 'ttttt', 1, 1, 1735042084, 0);

-- ----------------------------
-- Table structure for lh_active_code_group
-- ----------------------------
DROP TABLE IF EXISTS `lh_active_code_group`;
CREATE TABLE `lh_active_code_group`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL DEFAULT 0 COMMENT '所属商户',
  `group_name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '分组名称',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
  `create_user` int(11) NOT NULL DEFAULT 0 COMMENT '创建人',
  `create_time` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lh_active_code_group
-- ----------------------------
INSERT INTO `lh_active_code_group` VALUES (2, 2, 'WS组', '这是备注', 1, 1, 1735029538, 0);
INSERT INTO `lh_active_code_group` VALUES (3, 2, 'TG组', '这是TG组备注', 1, 1, 1735029634, 0);

-- ----------------------------
-- Table structure for lh_config
-- ----------------------------
DROP TABLE IF EXISTS `lh_config`;
CREATE TABLE `lh_config`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '配置标题',
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '配置值',
  `group` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分组',
  `sort` smallint(6) NOT NULL DEFAULT 0 COMMENT '排序',
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '配置说明',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '配置表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lh_config
-- ----------------------------

-- ----------------------------
-- Table structure for lh_dict
-- ----------------------------
DROP TABLE IF EXISTS `lh_dict`;
CREATE TABLE `lh_dict`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '字典编码',
  `dict_sort` int(4) NULL DEFAULT 0 COMMENT '字典排序',
  `dict_label` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '字典标签',
  `dict_value` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '字典键值',
  `dict_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '字典类型',
  `css_class` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '样式属性（其他样式扩展）',
  `list_class` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '表格回显样式',
  `is_default` tinyint(1) NULL DEFAULT 0 COMMENT '是否默认（1是 0否）',
  `status` tinyint(1) NULL DEFAULT 0 COMMENT '状态（1正常 0停用）',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `remark` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 115 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '字典数据表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lh_dict
-- ----------------------------
INSERT INTO `lh_dict` VALUES (1, 1, '男', '0', 'sys_user_sex', '', '', 1, 1, '2024-12-21 10:06:23', '性别男');
INSERT INTO `lh_dict` VALUES (2, 2, '女', '1', 'sys_user_sex', '', '', 0, 1, '2024-12-21 10:06:23', '性别女');
INSERT INTO `lh_dict` VALUES (3, 3, '未知', '2', 'sys_user_sex', '', '', 0, 1, '2024-12-21 10:06:23', '性别未知');
INSERT INTO `lh_dict` VALUES (4, 1, '显示', '0', 'sys_show_hide', '', 'primary', 1, 1, '2024-12-21 10:06:23', '显示菜单');
INSERT INTO `lh_dict` VALUES (5, 2, '隐藏', '1', 'sys_show_hide', '', 'danger', 0, 1, '2024-12-21 10:06:23', '隐藏菜单');
INSERT INTO `lh_dict` VALUES (6, 1, '正常', '1', 'sys_normal_disable', '', 'primary', 1, 1, '2024-12-21 10:06:23', '正常状态');
INSERT INTO `lh_dict` VALUES (7, 2, '停用', '0', 'sys_normal_disable', '', 'danger', 0, 1, '2024-12-21 10:06:23', '停用状态');
INSERT INTO `lh_dict` VALUES (8, 1, '正常', '0', 'sys_job_status', '', 'primary', 1, 1, '2024-12-21 10:06:23', '正常状态');
INSERT INTO `lh_dict` VALUES (9, 2, '暂停', '1', 'sys_job_status', '', 'danger', 0, 1, '2024-12-21 10:06:23', '停用状态');
INSERT INTO `lh_dict` VALUES (10, 1, '默认', 'DEFAULT', 'sys_job_group', '', '', 1, 1, '2024-12-21 10:06:23', '默认分组');
INSERT INTO `lh_dict` VALUES (11, 2, '系统', 'SYSTEM', 'sys_job_group', '', '', 0, 1, '2024-12-21 10:06:23', '系统分组');
INSERT INTO `lh_dict` VALUES (12, 1, '是', '1', 'sys_yes_no', '', 'primary', 1, 1, '2024-12-21 10:06:23', '系统默认是');
INSERT INTO `lh_dict` VALUES (13, 2, '否', '0', 'sys_yes_no', '', 'danger', 0, 1, '2024-12-21 10:06:23', '系统默认否');
INSERT INTO `lh_dict` VALUES (14, 1, '通知', '1', 'sys_notice_type', '', 'warning', 1, 1, '2024-12-21 10:06:23', '通知');
INSERT INTO `lh_dict` VALUES (15, 2, '公告', '2', 'sys_notice_type', '', 'success', 0, 1, '2024-12-21 10:06:23', '公告');
INSERT INTO `lh_dict` VALUES (16, 1, '正常', '0', 'sys_notice_status', '', 'primary', 1, 1, '2024-12-21 10:06:23', '正常状态');
INSERT INTO `lh_dict` VALUES (17, 2, '关闭', '1', 'sys_notice_status', '', 'danger', 0, 1, '2024-12-21 10:06:23', '关闭状态');
INSERT INTO `lh_dict` VALUES (18, 99, '其他', '0', 'sys_oper_type', '', 'info', 0, 1, '2024-12-21 10:06:23', '其他操作');
INSERT INTO `lh_dict` VALUES (19, 1, '新增', '1', 'sys_oper_type', '', 'info', 0, 1, '2024-12-21 10:06:23', '新增操作');
INSERT INTO `lh_dict` VALUES (20, 2, '修改', '2', 'sys_oper_type', '', 'info', 0, 1, '2024-12-21 10:06:23', '修改操作');
INSERT INTO `lh_dict` VALUES (21, 3, '删除', '3', 'sys_oper_type', '', 'danger', 0, 1, '2024-12-21 10:06:23', '删除操作');
INSERT INTO `lh_dict` VALUES (22, 4, '授权', '4', 'sys_oper_type', '', 'primary', 0, 1, '2024-12-21 10:06:23', '授权操作');
INSERT INTO `lh_dict` VALUES (23, 5, '导出', '5', 'sys_oper_type', '', 'warning', 0, 1, '2024-12-21 10:06:23', '导出操作');
INSERT INTO `lh_dict` VALUES (24, 6, '导入', '6', 'sys_oper_type', '', 'warning', 0, 1, '2024-12-21 10:06:23', '导入操作');
INSERT INTO `lh_dict` VALUES (25, 7, '强退', '7', 'sys_oper_type', '', 'danger', 0, 1, '2024-12-21 10:06:23', '强退操作');
INSERT INTO `lh_dict` VALUES (26, 8, '生成代码', '8', 'sys_oper_type', '', 'warning', 0, 1, '2024-12-21 10:06:23', '生成操作');
INSERT INTO `lh_dict` VALUES (27, 9, '清空数据', '9', 'sys_oper_type', '', 'danger', 0, 1, '2024-12-21 10:06:23', '清空操作');
INSERT INTO `lh_dict` VALUES (28, 1, '成功', '0', 'sys_common_status', '', 'primary', 0, 1, '2024-12-21 10:06:23', '正常状态');
INSERT INTO `lh_dict` VALUES (29, 2, '失败', '1', 'sys_common_status', '', 'danger', 0, 1, '2024-12-21 10:06:23', '停用状态');
INSERT INTO `lh_dict` VALUES (100, 1, 'WhatsApp', 'whatsapp', 'sys_trans_platform', '', 'default', 1, 1, '2024-12-23 11:26:45', 'WhatsApp');
INSERT INTO `lh_dict` VALUES (101, 2, 'Telegram', 'telegram', 'sys_trans_platform', '', 'default', 0, 1, '2024-12-23 11:27:49', 'Telegram');
INSERT INTO `lh_dict` VALUES (102, 1, '正常', '1', 'sys_time_status', '', 'primary', 1, 1, '2024-12-23 11:40:54', '');
INSERT INTO `lh_dict` VALUES (103, 2, '停用', '0', 'sys_time_status', '', 'danger', 0, 1, '2024-12-23 11:41:42', '停用');
INSERT INTO `lh_dict` VALUES (104, 3, '已到期', '2', 'sys_time_status', '', 'warning', 0, 1, '2024-12-23 11:42:05', '已到期');
INSERT INTO `lh_dict` VALUES (105, 1, '专业翻译', 'profession', 'sys_trans_type', '', 'default', 0, 1, '2024-12-23 16:47:50', '专业翻译');
INSERT INTO `lh_dict` VALUES (106, 2, '普通翻译', 'general', 'sys_trans_type', '', 'default', 1, 1, '2024-12-23 16:48:09', '普通翻译');
INSERT INTO `lh_dict` VALUES (107, 1, '在线', '1', 'sys_online_status', '', 'primary', 0, 1, '2024-12-25 14:29:21', '');
INSERT INTO `lh_dict` VALUES (108, 2, '离线', '0', 'sys_online_status', '', 'danger', 1, 1, '2024-12-25 14:29:51', '');
INSERT INTO `lh_dict` VALUES (109, 1, '占用', '1', 'sys_port_status', '', 'primary', 1, 1, '2024-12-25 14:30:25', '');
INSERT INTO `lh_dict` VALUES (110, 2, '释放', '0', 'sys_port_status', '', 'danger', 0, 1, '2024-12-25 14:30:55', '');
INSERT INTO `lh_dict` VALUES (111, 1, 'BOSS', 'boss', 'sys_link_type', '', 'default', 1, 1, '2024-12-25 19:29:02', 'BOSS短链');
INSERT INTO `lh_dict` VALUES (112, 2, '自定义', 'customize', 'sys_link_type', '', 'default', 0, 1, '2024-12-25 19:33:32', '自定义短链');
INSERT INTO `lh_dict` VALUES (113, 1, '新粉', '1', 'sys_fans_type', '', 'default', 1, 1, '2024-12-26 14:45:42', '新粉');
INSERT INTO `lh_dict` VALUES (114, 2, '老粉', '2', 'sys_fans_type', '', 'default', 0, 1, '2024-12-26 14:45:57', '');

-- ----------------------------
-- Table structure for lh_dict_type
-- ----------------------------
DROP TABLE IF EXISTS `lh_dict_type`;
CREATE TABLE `lh_dict_type`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '字典主键',
  `dict_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '字典名称',
  `dict_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '字典类型',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '0' COMMENT '状态（0正常 1停用）',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `remark` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `dict_type`(`dict_type`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 107 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '字典类型表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lh_dict_type
-- ----------------------------
INSERT INTO `lh_dict_type` VALUES (1, '用户性别', 'sys_user_sex', '1', '2024-12-21 10:06:23', '用户性别列表');
INSERT INTO `lh_dict_type` VALUES (2, '显示状态', 'sys_show_hide', '1', '2024-12-21 10:06:23', '菜单状态列表');
INSERT INTO `lh_dict_type` VALUES (3, '系统开关', 'sys_normal_disable', '1', '2024-12-21 10:06:23', '系统开关列表');
INSERT INTO `lh_dict_type` VALUES (4, '任务状态', 'sys_job_status', '1', '2024-12-21 10:06:23', '任务状态列表');
INSERT INTO `lh_dict_type` VALUES (5, '任务分组', 'sys_job_group', '1', '2024-12-21 10:06:23', '任务分组列表');
INSERT INTO `lh_dict_type` VALUES (6, '系统是否', 'sys_yes_no', '1', '2024-12-21 10:06:23', '系统是否列表');
INSERT INTO `lh_dict_type` VALUES (7, '通知类型', 'sys_notice_type', '1', '2024-12-21 10:06:23', '通知类型列表');
INSERT INTO `lh_dict_type` VALUES (8, '通知状态', 'sys_notice_status', '1', '2024-12-21 10:06:23', '通知状态列表');
INSERT INTO `lh_dict_type` VALUES (9, '操作类型', 'sys_oper_type', '1', '2024-12-21 10:06:23', '操作类型列表');
INSERT INTO `lh_dict_type` VALUES (10, '系统状态', 'sys_common_status', '1', '2024-12-21 10:06:23', '登录状态列表');
INSERT INTO `lh_dict_type` VALUES (100, '翻译平台', 'sys_trans_platform', '1', '2024-12-23 11:26:00', '翻译器支持平台');
INSERT INTO `lh_dict_type` VALUES (101, '到期状态', 'sys_time_status', '1', '2024-12-23 11:40:27', '到期状态');
INSERT INTO `lh_dict_type` VALUES (102, '翻译专业类型', 'sys_trans_type', '1', '2024-12-23 16:43:47', '翻译专业类型');
INSERT INTO `lh_dict_type` VALUES (103, '在线状态', 'sys_online_status', '1', '2024-12-25 14:28:26', '在线状态列表');
INSERT INTO `lh_dict_type` VALUES (104, '端口状态', 'sys_port_status', '1', '2024-12-25 14:28:58', '端口状态列表');
INSERT INTO `lh_dict_type` VALUES (105, '短链平台', 'sys_link_type', '1', '2024-12-25 19:28:32', '生成短链平台');
INSERT INTO `lh_dict_type` VALUES (106, '粉丝类型', 'sys_fans_type', '1', '2024-12-26 14:45:17', '粉丝类型');

-- ----------------------------
-- Table structure for lh_keyword
-- ----------------------------
DROP TABLE IF EXISTS `lh_keyword`;
CREATE TABLE `lh_keyword`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NULL DEFAULT NULL,
  `keyword` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '敏感词',
  `keyword_type` int(11) NOT NULL COMMENT '分类',
  `is_refuse` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '拒绝发送',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lh_keyword
-- ----------------------------
INSERT INTO `lh_keyword` VALUES (1, 2, '打死你', 4, '1', 1735209133);

-- ----------------------------
-- Table structure for lh_keyword_type
-- ----------------------------
DROP TABLE IF EXISTS `lh_keyword_type`;
CREATE TABLE `lh_keyword_type`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL DEFAULT 0 COMMENT '所属商户',
  `type_name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '分类名称',
  `create_time` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lh_keyword_type
-- ----------------------------
INSERT INTO `lh_keyword_type` VALUES (4, 2, '暴力', 1735208495);

-- ----------------------------
-- Table structure for lh_language
-- ----------------------------
DROP TABLE IF EXISTS `lh_language`;
CREATE TABLE `lh_language`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '语言名称',
  `lang_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '语言编码',
  `lang_sort` tinyint(3) NOT NULL DEFAULT 0 COMMENT '语言排序',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lh_language
-- ----------------------------
INSERT INTO `lh_language` VALUES (1, '英语', 'en', 90, 1, 0);
INSERT INTO `lh_language` VALUES (2, '中文', 'zh', 89, 1, 0);
INSERT INTO `lh_language` VALUES (3, '德语', 'de', 88, 1, 0);

-- ----------------------------
-- Table structure for lh_merchant
-- ----------------------------
DROP TABLE IF EXISTS `lh_merchant`;
CREATE TABLE `lh_merchant`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '商户名称',
  `platform_type` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '开通平台',
  `port_num` smallint(5) NOT NULL COMMENT '端口数量',
  `resource` tinyint(1) NOT NULL COMMENT '素材权限',
  `expire_time` int(11) NOT NULL COMMENT '到期时间',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态 1：正常 0停用 2 已到期',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  `create_time` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '代理表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lh_merchant
-- ----------------------------
INSERT INTO `lh_merchant` VALUES (1, '浪潮出海', 'whatsapp,telegram', 10, 1, 1734624000, 1, '1', 1734436535, 0);
INSERT INTO `lh_merchant` VALUES (2, '蓝海跨境', 'whatsapp,telegram', 10, 1, 1735574400, 1, '蓝海跨境', 1734941083, 0);
INSERT INTO `lh_merchant` VALUES (3, '悟空出海', 'telegram', 10, 1, 1735574400, 1, '悟空出海', 1734941246, 0);

-- ----------------------------
-- Table structure for lh_merchant_user
-- ----------------------------
DROP TABLE IF EXISTS `lh_merchant_user`;
CREATE TABLE `lh_merchant_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL COMMENT '商户ID',
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '登入账号',
  `realname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '真实姓名',
  `password` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '登录密码',
  `salt` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密码盐',
  `token` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '身份标识',
  `role_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '角色id',
  `last_login_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后登录时间',
  `last_login_ip` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后登录IP',
  `fail_times` tinyint(3) NOT NULL DEFAULT 0 COMMENT '登录失败次数',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '状态1正常 0 禁用',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `deleted` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否删除0 未删除 1已删除',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lh_merchant_user
-- ----------------------------
INSERT INTO `lh_merchant_user` VALUES (1, 2, 'lanhai', '蓝海', '671ded640b0edc7d19bef963e72f913a', 'ZI39qm', '62a2c94855c91ae4a5371706481295c8', 1, 0, 0, 0, 1, 1734941083, 0);
INSERT INTO `lh_merchant_user` VALUES (2, 3, 'wukong', '悟空', 'cd1aeda53125f087f67d6dd44b3daca7', 'RtGLNb', 'dbdb8ceb2332240d9f65222acaebf910', 1, 0, 0, 0, 1, 1734941246, 0);
INSERT INTO `lh_merchant_user` VALUES (3, 1, 'langchao', '浪潮', 'cd1aeda53125f087f67d6dd44b3daca7', 'RtGLNb', 'dbdb8ceb2332240d9f65222acaebf345', 1, 0, 0, 0, 1, 0, 0);

-- ----------------------------
-- Table structure for lh_node
-- ----------------------------
DROP TABLE IF EXISTS `lh_node`;
CREATE TABLE `lh_node`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '节点名称',
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上级ID',
  `url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '地址',
  `sort` smallint(6) NOT NULL DEFAULT 0 COMMENT '排序',
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '图标',
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '菜单  1 按钮 2',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '状态 1 显示 0 隐藏',
  `app_type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin' COMMENT '所属应用',
  `deleted` tinyint(3) UNSIGNED NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1083 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lh_node
-- ----------------------------
INSERT INTO `lh_node` VALUES (1001, '系统管理', 0, 'system', 1, 'fa fa-gear', 1, 1, 'admin', 0);
INSERT INTO `lh_node` VALUES (1002, '用户管理', 1001, 'user/index', 12, 'fa fa-user', 1, 1, 'admin', 0);
INSERT INTO `lh_node` VALUES (1003, '角色管理', 1001, 'role/index', 11, 'fa fa-bookmark', 1, 1, 'admin', 0);
INSERT INTO `lh_node` VALUES (1004, '节点管理', 1001, 'node/index', 8, 'fa fa-server', 1, 1, 'admin', 0);
INSERT INTO `lh_node` VALUES (1015, '订单管理', 0, 'productOrder/index', 80, 'fa fa-bars', 1, 1, 'admin', 1);
INSERT INTO `lh_node` VALUES (1021, '订单列表', 1015, 'productOrder/index', 99, 'fa fa-bars', 1, 1, 'admin', 1);
INSERT INTO `lh_node` VALUES (1025, '配置管理', 0, '#', 88, 'fa fa-navicon', 1, 1, 'admin', 0);
INSERT INTO `lh_node` VALUES (1026, '配置管理', 1025, 'config/index', 99, 'fa fa-bars', 1, 1, 'admin', 0);
INSERT INTO `lh_node` VALUES (1027, '商户管理', 0, '#', 99, 'fa fa-user', 1, 1, 'admin', 0);
INSERT INTO `lh_node` VALUES (1028, '商户管理', 1027, 'merchant/index', 99, '', 1, 1, 'admin', 0);
INSERT INTO `lh_node` VALUES (1061, '激活码管理', 1027, 'activeCode/index', 99, '', 1, 1, 'admin', 0);
INSERT INTO `lh_node` VALUES (1062, '工单管理', 1027, 'workOrder/index', 99, '', 1, 1, 'admin', 0);
INSERT INTO `lh_node` VALUES (1063, '帐号管理', 1027, 'workOrderAccount/index', 99, '', 1, 1, 'admin', 0);
INSERT INTO `lh_node` VALUES (1064, '代码生成', 1001, 'crud/index', 1, '', 1, 1, 'admin', 0);
INSERT INTO `lh_node` VALUES (1065, '激活码分组', 1027, 'activeCodeGroup/index', 50, '', 1, 1, 'admin', 0);
INSERT INTO `lh_node` VALUES (1066, '字典管理', 1001, 'dictType/index', 30, '', 1, 1, 'admin', 0);
INSERT INTO `lh_node` VALUES (1068, '翻译管理', 0, '#', 80, 'fa fa-exchange', 1, 1, 'admin', 0);
INSERT INTO `lh_node` VALUES (1069, '引擎管理', 1068, 'translateEngine/index', 99, '', 1, 1, 'admin', 0);
INSERT INTO `lh_node` VALUES (1070, '语言管理', 1068, 'language/index', 90, '', 1, 1, 'admin', 0);
INSERT INTO `lh_node` VALUES (1071, '任务管理', 0, '#', 99, 'fa fa-address-book-o', 1, 1, 'merchant', 0);
INSERT INTO `lh_node` VALUES (1072, '分流管理', 0, '#', 80, 'fa fa-bars', 1, 1, 'merchant', 0);
INSERT INTO `lh_node` VALUES (1073, '内容管理', 0, '#', 70, 'fa fa-reorder', 1, 1, 'merchant', 0);
INSERT INTO `lh_node` VALUES (1074, '系统管理', 0, '#', 1, 'fa fa-wrench', 1, 1, 'merchant', 0);
INSERT INTO `lh_node` VALUES (1075, '用户管理', 1074, 'merchantUser/index', 99, '', 1, 1, 'merchant', 0);
INSERT INTO `lh_node` VALUES (1076, '激活码管理', 1071, 'activeCode/index', 99, '', 1, 1, 'merchant', 0);
INSERT INTO `lh_node` VALUES (1077, '激活码分组', 1071, 'activeCodeGroup/index', 90, '', 1, 1, 'merchant', 0);
INSERT INTO `lh_node` VALUES (1078, '工单管理', 1071, 'workOrder/index', 80, '', 1, 1, 'merchant', 0);
INSERT INTO `lh_node` VALUES (1079, '粉丝管理', 1071, 'workOrderFans/index', 60, '', 1, 1, 'merchant', 0);
INSERT INTO `lh_node` VALUES (1080, '敏感词管理', 1073, 'keyword/index', 99, '', 1, 1, 'merchant', 0);
INSERT INTO `lh_node` VALUES (1081, '敏感词分类', 1073, 'keywordType/index', 90, '', 1, 1, 'merchant', 0);
INSERT INTO `lh_node` VALUES (1082, '素材类型', 1073, 'resourceType/index', 30, '', 1, 1, 'merchant', 0);

-- ----------------------------
-- Table structure for lh_order_id
-- ----------------------------
DROP TABLE IF EXISTS `lh_order_id`;
CREATE TABLE `lh_order_id`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `use_date` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of lh_order_id
-- ----------------------------
INSERT INTO `lh_order_id` VALUES (1, '');
INSERT INTO `lh_order_id` VALUES (2, '');
INSERT INTO `lh_order_id` VALUES (3, '');
INSERT INTO `lh_order_id` VALUES (4, '');
INSERT INTO `lh_order_id` VALUES (5, '');
INSERT INTO `lh_order_id` VALUES (6, '');
INSERT INTO `lh_order_id` VALUES (7, '');
INSERT INTO `lh_order_id` VALUES (8, '');
INSERT INTO `lh_order_id` VALUES (9, '');
INSERT INTO `lh_order_id` VALUES (10, '241224');
INSERT INTO `lh_order_id` VALUES (11, '241224');
INSERT INTO `lh_order_id` VALUES (12, '241224');
INSERT INTO `lh_order_id` VALUES (13, '241224');
INSERT INTO `lh_order_id` VALUES (14, '241224');
INSERT INTO `lh_order_id` VALUES (15, '241224');
INSERT INTO `lh_order_id` VALUES (16, '241224');
INSERT INTO `lh_order_id` VALUES (17, '241224');

-- ----------------------------
-- Table structure for lh_resource
-- ----------------------------
DROP TABLE IF EXISTS `lh_resource`;
CREATE TABLE `lh_resource`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL COMMENT '商户ID',
  `resource_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '资源名称',
  `resource_type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '资源类型',
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '内容',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lh_resource
-- ----------------------------

-- ----------------------------
-- Table structure for lh_resource_type
-- ----------------------------
DROP TABLE IF EXISTS `lh_resource_type`;
CREATE TABLE `lh_resource_type`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL DEFAULT 0 COMMENT '所属商户',
  `type_name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '分类名称',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lh_resource_type
-- ----------------------------
INSERT INTO `lh_resource_type` VALUES (2, 2, '1');
INSERT INTO `lh_resource_type` VALUES (3, 2, 'TG组');

-- ----------------------------
-- Table structure for lh_role
-- ----------------------------
DROP TABLE IF EXISTS `lh_role`;
CREATE TABLE `lh_role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '角色名称',
  `rules` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '权限组',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '描述',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态 1启用  0 禁用',
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lh_role
-- ----------------------------
INSERT INTO `lh_role` VALUES (1, '超级管理员', '', '超级管理员', 1, 0);
INSERT INTO `lh_role` VALUES (2, '业务', NULL, '业务专员', 1, 0);
INSERT INTO `lh_role` VALUES (3, '财务', NULL, '审核专员', 1, 0);
INSERT INTO `lh_role` VALUES (4, '代理2', NULL, '只走U充值', 1, 1);

-- ----------------------------
-- Table structure for lh_system_log
-- ----------------------------
DROP TABLE IF EXISTS `lh_system_log`;
CREATE TABLE `lh_system_log`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户名',
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '操作标题',
  `method` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '操作方法',
  `params` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '请求参数',
  `ip` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'IP地址',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `deleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否删除',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 695 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lh_system_log
-- ----------------------------
INSERT INTO `lh_system_log` VALUES (639, 'admin', '/admin/crud/save', '/admin/crud/save', '{\"table_name\":\"active_code\",\"app_name\":\"merchant\",\"is_view\":\"1\",\"is_node\":\"1\",\"node\":{\"parent_id\":\"1071\",\"title\":\"\\u6fc0\\u6d3b\\u7801\\u7ba1\\u7406\",\"sort\":\"99\"},\"comment\":{\"id\":\"id\",\"merchant_id\":\"\\u5546\\u6237ID\",\"active_code\":\"\\u6fc0\\u6d3b\\u7801\",\"active_code_group_id\":\"\\u6240\\u5c5e\\u5206\\u7ec4\",\"port_num\":\"\\u5206\\u914d\\u7aef\\u53e3\",\"expire_time\":\"\\u5931\\u6548\\u65f6\\u95f4\",\"platform\":\"\\u4f7f\\u7528\\u5e73\\u53f0\",\"remark\":\"\\u5907\\u6ce8\",\"content\":\"\\u8bf4\\u660e\",\"status\":\"\\u72b6\\u6001\",\"create_user\":\"\\u521b\\u5efa\\u4eba\",\"create_time\":\"\\u521b\\u5efa\\u65f6\\u95f4\",\"deleted\":\"deleted\"},\"search\":[\"merchant_id\",\"active_code\",\"active_code_group_id\",\"platform\"],\"require\":[\"merchant_id\",\"active_code\",\"active_code_group_id\",\"port_num\",\"expire_time\",\"platform\",\"status\",\"create_user\"],\"form_type\":{\"merchant_id\":\"input\",\"active_code\":\"input\",\"active_code_group_id\":\"input\",\"port_num\":\"input\",\"expire_time\":\"date\",\"platform\":\"checkbox\",\"remark\":\"textarea\",\"content\":\"textarea\",\"status\":\"radio\",\"create_user\":\"input\",\"create_time\":\"input\"},\"dict\":{\"merchant_id\":\"\",\"active_code\":\"\",\"active_code_group_id\":\"\",\"port_num\":\"\",\"expire_time\":\"\",\"platform\":\"\",\"remark\":\"\",\"content\":\"\",\"status\":\"sys_normal_disable\",\"create_user\":\"\",\"create_time\":\"\"}}', '127.0.0.1', 1735024636, 0);
INSERT INTO `lh_system_log` VALUES (640, 'admin', '/admin/node/index', '/admin/node/index', '[]', '127.0.0.1', 1735024789, 0);
INSERT INTO `lh_system_log` VALUES (641, 'admin', '/admin/node/index', '/admin/node/index', '{\"title\":\"\",\"status\":\"\",\"app_type\":\"merchant\"}', '127.0.0.1', 1735024791, 0);
INSERT INTO `lh_system_log` VALUES (642, 'admin', '/admin/node/index', '/admin/node/index', '{\"title\":\"\",\"status\":\"\",\"app_type\":\"merchant\"}', '127.0.0.1', 1735024792, 0);
INSERT INTO `lh_system_log` VALUES (643, 'admin', '/admin/node/index', '/admin/node/index', '{\"title\":\"\",\"status\":\"\",\"app_type\":\"merchant\"}', '127.0.0.1', 1735024793, 0);
INSERT INTO `lh_system_log` VALUES (644, 'admin', '/admin/node/index', '/admin/node/index', '{\"title\":\"\",\"status\":\"\",\"app_type\":\"merchant\"}', '127.0.0.1', 1735024793, 0);
INSERT INTO `lh_system_log` VALUES (645, 'admin', '/admin/node/index', '/admin/node/index', '{\"title\":\"\",\"status\":\"\",\"app_type\":\"merchant\"}', '127.0.0.1', 1735024793, 0);
INSERT INTO `lh_system_log` VALUES (646, 'admin', '/admin/node/index', '/admin/node/index', '{\"title\":\"\",\"status\":\"\",\"app_type\":\"merchant\"}', '127.0.0.1', 1735024794, 0);
INSERT INTO `lh_system_log` VALUES (647, 'admin', '/admin/node/index', '/admin/node/index', '{\"title\":\"\",\"status\":\"\",\"app_type\":\"merchant\"}', '127.0.0.1', 1735024795, 0);
INSERT INTO `lh_system_log` VALUES (648, 'admin', '/admin/node/index', '/admin/node/index', '{\"title\":\"\",\"status\":\"\",\"app_type\":\"merchant\"}', '127.0.0.1', 1735024795, 0);
INSERT INTO `lh_system_log` VALUES (649, 'admin', '/admin/node/index', '/admin/node/index', '{\"title\":\"\",\"status\":\"\",\"app_type\":\"merchant\"}', '127.0.0.1', 1735024795, 0);
INSERT INTO `lh_system_log` VALUES (650, 'admin', '/admin/node/index', '/admin/node/index', '{\"title\":\"\",\"status\":\"\",\"app_type\":\"merchant\"}', '127.0.0.1', 1735024798, 0);
INSERT INTO `lh_system_log` VALUES (651, 'admin', '/admin/node/save', '/admin/node/save', '{\"parent_id\":\"1071\",\"type\":\"1\",\"title\":\"\\u6fc0\\u6d3b\\u7801\\u7ba1\\u7406\",\"app_type\":\"merchant\",\"url\":\"activeCode\\/index\",\"sort\":\"99\",\"icon\":\"\",\"status\":\"1\"}', '127.0.0.1', 1735024829, 0);
INSERT INTO `lh_system_log` VALUES (652, 'admin', '/admin/node/index', '/admin/node/index', '{\"title\":\"\",\"status\":\"\",\"app_type\":\"merchant\"}', '127.0.0.1', 1735024829, 0);
INSERT INTO `lh_system_log` VALUES (653, 'admin', '/admin/translateEngine/save', '/admin/translateEngine/save', '{\"id\":\"5\",\"engine_name\":\"\\u8c46\\u5305\",\"engine_code\":\"doubao\",\"engine_type\":\"profession\",\"engine_sort\":\"60\",\"status\":\"1\"}', '127.0.0.1', 1735029267, 0);
INSERT INTO `lh_system_log` VALUES (654, 'admin', '/admin/crud/save', '/admin/crud/save', '{\"table_name\":\"active_code_group\",\"app_name\":\"merchant\",\"is_view\":\"1\",\"is_node\":\"1\",\"node\":{\"parent_id\":\"1071\",\"title\":\"\\u6fc0\\u6d3b\\u7801\\u5206\\u7ec4\",\"sort\":\"90\"},\"comment\":{\"id\":\"id\",\"merchant_id\":\"\\u6240\\u5c5e\\u5546\\u6237\",\"group_name\":\"\\u5206\\u7ec4\\u540d\\u79f0\",\"remark\":\"\\u5907\\u6ce8\",\"status\":\"\\u72b6\\u6001\",\"create_user\":\"\\u521b\\u5efa\\u4eba\",\"create_time\":\"\\u521b\\u5efa\\u65f6\\u95f4\",\"deleted\":\"deleted\"},\"search\":[\"merchant_id\",\"group_name\",\"status\"],\"require\":[\"merchant_id\",\"group_name\",\"remark\",\"status\"],\"form_type\":{\"merchant_id\":\"input\",\"group_name\":\"input\",\"remark\":\"input\",\"status\":\"radio\",\"create_user\":\"input\",\"create_time\":\"input\"},\"dict\":{\"merchant_id\":\"\",\"group_name\":\"\",\"remark\":\"\",\"status\":\"sys_normal_disable\",\"create_user\":\"\",\"create_time\":\"\"}}', '127.0.0.1', 1735029507, 0);
INSERT INTO `lh_system_log` VALUES (655, 'admin', '/admin/crud/save', '/admin/crud/save', '{\"table_name\":\"work_order\",\"app_name\":\"merchant\",\"is_view\":\"1\",\"is_node\":\"1\",\"node\":{\"parent_id\":\"1071\",\"title\":\"\\u6fc0\\u6d3b\\u7801\\u5206\\u7ec4\",\"sort\":\"80\"},\"comment\":{\"id\":\"id\",\"merchant_id\":\"\\u5546\\u6237ID\",\"order_code\":\"\\u5de5\\u5355\\u7f16\\u53f7\",\"active_code\":\"\\u6fc0\\u6d3b\\u7801\",\"order_name\":\"\\u5de5\\u5355\\u540d\\u79f0\",\"platform\":\"\\u5de5\\u5355\\u7c7b\\u578b\",\"port_num\":\"\\u7aef\\u53e3\\u6570\",\"port_use_num\":\"\\u4f7f\\u7528\\u7aef\\u53e3\",\"port_online_num\":\"\\u5728\\u7ebf\\u7aef\\u53e3\",\"fans_target_num\":\"\\u76ee\\u6807\\u603b\\u6570\",\"fans_num\":\"\\u8fdb\\u7c89\\u603b\\u6570\",\"fans_repeat_num\":\"\\u91cd\\u590d\\u7c89\\u6570\",\"today_fans_num\":\"\\u5f53\\u65e5\\u8fdb\\u7c89\\u6570\",\"share_password\":\"\\u5206\\u4eab\\u5bc6\\u7801\",\"share_expire_time\":\"\\u5931\\u6548\\u65f6\\u95f4\",\"clean_time\":\"\\u6e05\\u96f6\\u65f6\\u95f4\",\"reset_time\":\"\\u91cd\\u7f6e\\u65f6\\u95f4\",\"status\":\"\\u72b6\\u6001\\uff1a\",\"create_user\":\"\\u521b\\u5efa\\u4eba\",\"create_time\":\"\\u521b\\u5efa\\u65f6\\u95f4\",\"deleted\":\"deleted\"},\"search\":[\"merchant_id\",\"order_code\",\"active_code\",\"order_name\",\"platform\",\"status\"],\"require\":[\"merchant_id\",\"order_code\",\"active_code\",\"order_name\",\"platform\",\"port_num\",\"share_password\",\"share_expire_time\",\"clean_time\",\"reset_time\",\"status\"],\"form_type\":{\"merchant_id\":\"input\",\"order_code\":\"input\",\"active_code\":\"input\",\"order_name\":\"input\",\"platform\":\"input\",\"port_num\":\"input\",\"port_use_num\":\"input\",\"port_online_num\":\"input\",\"fans_target_num\":\"input\",\"fans_num\":\"input\",\"fans_repeat_num\":\"input\",\"today_fans_num\":\"input\",\"share_password\":\"input\",\"share_expire_time\":\"date\",\"clean_time\":\"input\",\"reset_time\":\"date\",\"status\":\"radio\",\"create_user\":\"input\",\"create_time\":\"input\"},\"dict\":{\"merchant_id\":\"\",\"order_code\":\"\",\"active_code\":\"\",\"order_name\":\"\",\"platform\":\"\",\"port_num\":\"\",\"port_use_num\":\"\",\"port_online_num\":\"\",\"fans_target_num\":\"\",\"fans_num\":\"\",\"fans_repeat_num\":\"\",\"today_fans_num\":\"\",\"share_password\":\"\",\"share_expire_time\":\"\",\"clean_time\":\"\",\"reset_time\":\"\",\"status\":\"sys_normal_disable\",\"create_user\":\"\",\"create_time\":\"\"}}', '127.0.0.1', 1735032087, 0);
INSERT INTO `lh_system_log` VALUES (656, 'admin', '/admin/crud/save', '/admin/crud/save', '{\"table_name\":\"work_order\",\"app_name\":\"merchant\",\"is_view\":\"1\",\"is_node\":\"1\",\"node\":{\"parent_id\":\"1071\",\"title\":\"\\u5de5\\u5355\\u7ba1\\u7406\",\"sort\":\"80\"},\"comment\":{\"id\":\"id\",\"merchant_id\":\"\\u5546\\u6237ID\",\"order_code\":\"\\u5de5\\u5355\\u7f16\\u53f7\",\"active_code\":\"\\u6fc0\\u6d3b\\u7801\",\"order_name\":\"\\u5de5\\u5355\\u540d\\u79f0\",\"platform\":\"\\u5de5\\u5355\\u7c7b\\u578b\",\"port_num\":\"\\u7aef\\u53e3\\u6570\",\"port_use_num\":\"\\u4f7f\\u7528\\u7aef\\u53e3\",\"port_online_num\":\"\\u5728\\u7ebf\\u7aef\\u53e3\",\"fans_target_num\":\"\\u76ee\\u6807\\u603b\\u6570\",\"fans_num\":\"\\u8fdb\\u7c89\\u603b\\u6570\",\"fans_repeat_num\":\"\\u91cd\\u590d\\u7c89\\u6570\",\"today_fans_num\":\"\\u5f53\\u65e5\\u8fdb\\u7c89\\u6570\",\"share_password\":\"\\u5206\\u4eab\\u5bc6\\u7801\",\"share_expire_time\":\"\\u5931\\u6548\\u65f6\\u95f4\",\"clean_time\":\"\\u6e05\\u96f6\\u65f6\\u95f4\",\"reset_time\":\"\\u91cd\\u7f6e\\u65f6\\u95f4\",\"status\":\"\\u72b6\\u6001\\uff1a\",\"create_user\":\"\\u521b\\u5efa\\u4eba\",\"create_time\":\"\\u521b\\u5efa\\u65f6\\u95f4\",\"deleted\":\"deleted\"},\"form_type\":{\"merchant_id\":\"input\",\"order_code\":\"input\",\"active_code\":\"input\",\"order_name\":\"input\",\"platform\":\"input\",\"port_num\":\"input\",\"port_use_num\":\"input\",\"port_online_num\":\"input\",\"fans_target_num\":\"input\",\"fans_num\":\"input\",\"fans_repeat_num\":\"input\",\"today_fans_num\":\"input\",\"share_password\":\"input\",\"share_expire_time\":\"input\",\"clean_time\":\"input\",\"reset_time\":\"input\",\"status\":\"input\",\"create_user\":\"input\",\"create_time\":\"input\"},\"dict\":{\"merchant_id\":\"\",\"order_code\":\"\",\"active_code\":\"\",\"order_name\":\"\",\"platform\":\"\",\"port_num\":\"\",\"port_use_num\":\"\",\"port_online_num\":\"\",\"fans_target_num\":\"\",\"fans_num\":\"\",\"fans_repeat_num\":\"\",\"today_fans_num\":\"\",\"share_password\":\"\",\"share_expire_time\":\"\",\"clean_time\":\"\",\"reset_time\":\"\",\"status\":\"\",\"create_user\":\"\",\"create_time\":\"\"}}', '127.0.0.1', 1735032109, 0);
INSERT INTO `lh_system_log` VALUES (657, 'admin', '/admin/crud/save', '/admin/crud/save', '{\"table_name\":\"work_order\",\"app_name\":\"merchant\",\"is_view\":\"1\",\"is_node\":\"1\",\"node\":{\"parent_id\":\"1071\",\"title\":\"\\u5de5\\u5355\\u7ba1\\u7406\",\"sort\":\"80\"},\"comment\":{\"id\":\"id\",\"merchant_id\":\"\\u5546\\u6237ID\",\"order_code\":\"\\u5de5\\u5355\\u7f16\\u53f7\",\"active_code\":\"\\u6fc0\\u6d3b\\u7801\",\"order_name\":\"\\u5de5\\u5355\\u540d\\u79f0\",\"platform\":\"\\u5de5\\u5355\\u7c7b\\u578b\",\"port_num\":\"\\u7aef\\u53e3\\u6570\",\"port_use_num\":\"\\u4f7f\\u7528\\u7aef\\u53e3\",\"port_online_num\":\"\\u5728\\u7ebf\\u7aef\\u53e3\",\"fans_target_num\":\"\\u76ee\\u6807\\u603b\\u6570\",\"fans_num\":\"\\u8fdb\\u7c89\\u603b\\u6570\",\"fans_repeat_num\":\"\\u91cd\\u590d\\u7c89\\u6570\",\"today_fans_num\":\"\\u5f53\\u65e5\\u8fdb\\u7c89\\u6570\",\"share_password\":\"\\u5206\\u4eab\\u5bc6\\u7801\",\"share_expire_time\":\"\\u5931\\u6548\\u65f6\\u95f4\",\"clean_time\":\"\\u6e05\\u96f6\\u65f6\\u95f4\",\"reset_time\":\"\\u91cd\\u7f6e\\u65f6\\u95f4\",\"status\":\"\\u72b6\\u6001\",\"create_user\":\"\\u521b\\u5efa\\u4eba\",\"create_time\":\"\\u521b\\u5efa\\u65f6\\u95f4\",\"deleted\":\"deleted\"},\"search\":[\"merchant_id\",\"order_code\",\"active_code\",\"order_name\",\"platform\"],\"require\":[\"merchant_id\",\"order_code\",\"active_code\",\"order_name\",\"platform\",\"port_num\",\"share_password\"],\"form_type\":{\"merchant_id\":\"input\",\"order_code\":\"input\",\"active_code\":\"input\",\"order_name\":\"input\",\"platform\":\"input\",\"port_num\":\"input\",\"port_use_num\":\"input\",\"port_online_num\":\"input\",\"fans_target_num\":\"input\",\"fans_num\":\"input\",\"fans_repeat_num\":\"input\",\"today_fans_num\":\"input\",\"share_password\":\"input\",\"share_expire_time\":\"date\",\"clean_time\":\"input\",\"reset_time\":\"date\",\"status\":\"radio\",\"create_user\":\"input\",\"create_time\":\"input\"},\"dict\":{\"merchant_id\":\"\",\"order_code\":\"\",\"active_code\":\"\",\"order_name\":\"\",\"platform\":\"sys_trans_platform\",\"port_num\":\"\",\"port_use_num\":\"\",\"port_online_num\":\"\",\"fans_target_num\":\"\",\"fans_num\":\"\",\"fans_repeat_num\":\"\",\"today_fans_num\":\"\",\"share_password\":\"\",\"share_expire_time\":\"\",\"clean_time\":\"\",\"reset_time\":\"\",\"status\":\"sys_normal_disable\",\"create_user\":\"\",\"create_time\":\"\"}}', '127.0.0.1', 1735032217, 0);
INSERT INTO `lh_system_log` VALUES (658, 'admin', '/admin/node/index', '/admin/node/index', '[]', '127.0.0.1', 1735038764, 0);
INSERT INTO `lh_system_log` VALUES (659, 'admin', '/admin/node/index', '/admin/node/index', '[]', '127.0.0.1', 1735046964, 0);
INSERT INTO `lh_system_log` VALUES (660, 'admin', '/admin/crud/save', '/admin/crud/save', '{\"table_name\":\"work_order_share\",\"app_name\":\"merchant\",\"is_view\":\"1\",\"is_node\":\"0\",\"node\":{\"parent_id\":\"\",\"title\":\"\",\"sort\":\"\"},\"comment\":{\"id\":\"id\",\"merchant_id\":\"\\u5546\\u6237ID\",\"order_code\":\"\\u5de5\\u5355\\u7f16\\u53f7\",\"link_type\":\"\\u77ed\\u94fe\\u5e73\\u53f0\",\"expire_time\":\"\\u5230\\u671f\\u65f6\\u95f4\",\"password\":\"\\u5206\\u4eab\\u5bc6\\u7801\",\"status\":\"\\u72b6\\u6001\",\"deleted\":\"deleted\"},\"search\":[\"merchant_id\",\"order_code\",\"status\"],\"require\":[\"merchant_id\",\"order_code\",\"link_type\",\"expire_time\",\"password\"],\"form_type\":{\"merchant_id\":\"input\",\"order_code\":\"input\",\"link_type\":\"input\",\"expire_time\":\"date\",\"password\":\"input\",\"status\":\"input\"},\"dict\":{\"merchant_id\":\"\",\"order_code\":\"\",\"link_type\":\"\",\"expire_time\":\"\",\"password\":\"\",\"status\":\"sys_normal_disable\"}}', '127.0.0.1', 1735047752, 0);
INSERT INTO `lh_system_log` VALUES (661, 'admin', '/admin/node/index', '/admin/node/index', '[]', '127.0.0.1', 1735107055, 0);
INSERT INTO `lh_system_log` VALUES (662, 'admin', '/admin/dictType/save', '/admin/dictType/save', '{\"dict_name\":\"\\u5728\\u7ebf\\u72b6\\u6001\\u5217\\u8868\",\"dict_type\":\"sys_online_status\",\"status\":\"1\",\"remark\":\"\\u5728\\u7ebf\\u72b6\\u6001\"}', '127.0.0.1', 1735108106, 0);
INSERT INTO `lh_system_log` VALUES (663, 'admin', '/admin/dictType/save', '/admin/dictType/save', '{\"id\":\"103\",\"dict_name\":\"\\u5728\\u7ebf\\u72b6\\u6001\",\"dict_type\":\"sys_online_status\",\"status\":\"1\",\"remark\":\"\\u5728\\u7ebf\\u72b6\\u6001\\u5217\\u8868\"}', '127.0.0.1', 1735108111, 0);
INSERT INTO `lh_system_log` VALUES (664, 'admin', '/admin/dictType/save', '/admin/dictType/save', '{\"dict_name\":\"\\u7aef\\u53e3\\u72b6\\u6001\",\"dict_type\":\"sys_port_status\",\"status\":\"1\",\"remark\":\"\\u7aef\\u53e3\\u72b6\\u6001\\u5217\\u8868\"}', '127.0.0.1', 1735108138, 0);
INSERT INTO `lh_system_log` VALUES (665, 'admin', '/admin/dict/save', '/admin/dict/save', '{\"dict_label\":\"\\u5728\\u7ebf\",\"dict_value\":\"1\",\"dict_sort\":\"1\",\"dict_type\":\"sys_online_status\",\"css_class\":\"\",\"list_class\":\"primary\",\"is_default\":\"0\",\"status\":\"1\",\"remark\":\"\"}', '127.0.0.1', 1735108160, 0);
INSERT INTO `lh_system_log` VALUES (666, 'admin', '/admin/dict/save', '/admin/dict/save', '{\"dict_label\":\"\\u79bb\\u7ebf\",\"dict_value\":\"0\",\"dict_sort\":\"2\",\"dict_type\":\"sys_online_status\",\"css_class\":\"\",\"list_class\":\"danger\",\"is_default\":\"1\",\"status\":\"1\",\"remark\":\"\"}', '127.0.0.1', 1735108190, 0);
INSERT INTO `lh_system_log` VALUES (667, 'admin', '/admin/dict/save', '/admin/dict/save', '{\"dict_label\":\"\\u5360\\u7528\",\"dict_value\":\"1\",\"dict_sort\":\"1\",\"dict_type\":\"sys_port_status\",\"css_class\":\"\",\"list_class\":\"primary\",\"is_default\":\"1\",\"status\":\"1\",\"remark\":\"\"}', '127.0.0.1', 1735108225, 0);
INSERT INTO `lh_system_log` VALUES (668, 'admin', '/admin/dict/save', '/admin/dict/save', '{\"dict_label\":\"\\u91ca\\u653e\",\"dict_value\":\"0\",\"dict_sort\":\"2\",\"dict_type\":\"sys_port_status\",\"css_class\":\"\",\"list_class\":\"danger\",\"is_default\":\"0\",\"status\":\"1\",\"remark\":\"\"}', '127.0.0.1', 1735108254, 0);
INSERT INTO `lh_system_log` VALUES (669, 'admin', '/admin/crud/save', '/admin/crud/save', '{\"table_name\":\"work_order_account\",\"app_name\":\"merchant\",\"is_view\":\"1\",\"is_node\":\"0\",\"node\":{\"parent_id\":\"\",\"title\":\"\",\"sort\":\"\"},\"comment\":{\"id\":\"id\",\"merchant_id\":\"\\u5546\\u6237ID\",\"active_code\":\"\\u6fc0\\u6d3b\\u7801\",\"order_code\":\"\\u5de5\\u5355\\u7f16\\u53f7\",\"account_name\":\"\\u8d26\\u6237\",\"mobile\":\"\\u624b\\u673a\\u53f7\",\"account_id\":\"\\u8d26\\u6237ID\",\"online_status\":\"\\u5728\\u7ebf\\u72b6\\u6001\",\"port_status\":\"\\u7aef\\u53e3\\u72b6\\u6001\",\"fans_target_num\":\"\\u76ee\\u6807\\u603b\\u6570\",\"fans_num\":\"\\u8fdb\\u7c89\\u603b\\u6570\",\"today_fans_repeat_num\":\"\\u5f53\\u65e5\\u91cd\\u590d\\u7c89\\u6570\",\"fans_repeat_num\":\"\\u91cd\\u590d\\u7c89\\u6570\",\"today_fans_num\":\"\\u5f53\\u65e5\\u8fdb\\u7c89\\u6570\",\"today_fans_target_num\":\"\\u5f53\\u65e5\\u8fdb\\u7c89\\u76ee\\u6807\",\"online_time\":\"\\u4e0a\\u7ebf\\u65f6\\u95f4\",\"offline_time\":\"\\u4e0b\\u7ebf\\u65f6\\u95f4\",\"account_link\":\"\\u4e3b\\u53f7\\u8fde\\u63a5\",\"token\":\"\\u7528\\u6237token\",\"deleted\":\"deleted\"},\"search\":[\"merchant_id\",\"active_code\",\"order_code\",\"mobile\",\"online_status\",\"port_status\"],\"require\":[\"merchant_id\",\"active_code\",\"order_code\",\"account_name\",\"mobile\",\"account_id\"],\"form_type\":{\"merchant_id\":\"input\",\"active_code\":\"input\",\"order_code\":\"input\",\"account_name\":\"input\",\"mobile\":\"input\",\"account_id\":\"input\",\"online_status\":\"radio\",\"port_status\":\"radio\",\"fans_target_num\":\"input\",\"fans_num\":\"input\",\"today_fans_repeat_num\":\"input\",\"fans_repeat_num\":\"input\",\"today_fans_num\":\"input\",\"today_fans_target_num\":\"input\",\"online_time\":\"input\",\"offline_time\":\"input\",\"account_link\":\"input\",\"token\":\"input\"},\"dict\":{\"merchant_id\":\"\",\"active_code\":\"\",\"order_code\":\"\",\"account_name\":\"\",\"mobile\":\"\",\"account_id\":\"\",\"online_status\":\"sys_online_status\",\"port_status\":\"sys_port_status\",\"fans_target_num\":\"\",\"fans_num\":\"\",\"today_fans_repeat_num\":\"\",\"fans_repeat_num\":\"\",\"today_fans_num\":\"\",\"today_fans_target_num\":\"\",\"online_time\":\"\",\"offline_time\":\"\",\"account_link\":\"\",\"token\":\"\"}}', '127.0.0.1', 1735108332, 0);
INSERT INTO `lh_system_log` VALUES (670, 'admin', '/admin/login/login', '/admin/login/login', '{\"username\":\"7cdaae51c30dc05cf620402103bcd600\",\"password\":\"7cdaae51c30dc05cf620402103bcd600\",\"verify_code\":\"02b995cf51c7b60600c8313780b9458a\",\"rememberMe\":\"false\"}', '127.0.0.1', 1735125838, 0);
INSERT INTO `lh_system_log` VALUES (671, 'admin', '/admin/dictType/save', '/admin/dictType/save', '{\"id\":\"2\",\"dict_name\":\"\\u663e\\u793a\\u72b6\\u6001\",\"dict_type\":\"sys_show_hide\",\"status\":\"1\",\"remark\":\"\\u83dc\\u5355\\u72b6\\u6001\\u5217\\u8868\"}', '127.0.0.1', 1735125963, 0);
INSERT INTO `lh_system_log` VALUES (672, 'admin', '/admin/dictType/save', '/admin/dictType/save', '{\"dict_name\":\"\\u77ed\\u94fe\\u5e73\\u53f0\",\"dict_type\":\"sys_link_type\",\"status\":\"1\",\"remark\":\"\\u751f\\u6210\\u77ed\\u94fe\\u5e73\\u53f0\"}', '127.0.0.1', 1735126111, 0);
INSERT INTO `lh_system_log` VALUES (673, 'admin', '/admin/dict/save', '/admin/dict/save', '{\"dict_label\":\"BOSS\",\"dict_value\":\"boss\",\"dict_sort\":\"1\",\"dict_type\":\"sys_link_type\",\"css_class\":\"\",\"list_class\":\"\",\"is_default\":\"1\",\"status\":\"1\",\"remark\":\"BOSS\\u77ed\\u94fe\"}', '127.0.0.1', 1735126132, 0);
INSERT INTO `lh_system_log` VALUES (674, 'admin', '/admin/dict/save', '/admin/dict/save', '{\"dict_label\":\"BOSS\",\"dict_value\":\"boss\",\"dict_sort\":\"1\",\"dict_type\":\"sys_link_type\",\"css_class\":\"\",\"list_class\":\"default\",\"is_default\":\"1\",\"status\":\"1\",\"remark\":\"BOSS\\u77ed\\u94fe\"}', '127.0.0.1', 1735126141, 0);
INSERT INTO `lh_system_log` VALUES (675, 'admin', '/admin/dict/save', '/admin/dict/save', '{\"dict_label\":\"\\u81ea\\u5b9a\\u4e49\",\"dict_value\":\"customize\",\"dict_sort\":\"2\",\"dict_type\":\"sys_link_type\",\"css_class\":\"\",\"list_class\":\"default\",\"is_default\":\"0\",\"status\":\"1\",\"remark\":\"\\u81ea\\u5b9a\\u4e49\"}', '127.0.0.1', 1735126412, 0);
INSERT INTO `lh_system_log` VALUES (676, 'admin', '/admin/dict/save', '/admin/dict/save', '{\"id\":\"112\",\"dict_label\":\"\\u81ea\\u5b9a\\u4e49\",\"dict_value\":\"customize\",\"dict_sort\":\"2\",\"dict_type\":\"sys_link_type\",\"css_class\":\"\",\"list_class\":\"default\",\"is_default\":\"0\",\"status\":\"1\",\"remark\":\"\\u81ea\\u5b9a\\u4e49\\u77ed\\u94fe\"}', '127.0.0.1', 1735126420, 0);
INSERT INTO `lh_system_log` VALUES (677, 'admin', '/admin/crud/save', '/admin/crud/save', '{\"table_name\":\"work_order_branch\",\"app_name\":\"merchant\",\"is_view\":\"1\",\"is_node\":\"0\",\"node\":{\"parent_id\":\"\",\"title\":\"\",\"sort\":\"\"},\"comment\":{\"id\":\"id\",\"merchant_id\":\"\\u5546\\u6237ID\",\"order_code\":\"\\u5de5\\u5355\\u7f16\\u53f7\",\"link_type\":\"\\u77ed\\u94fe\\u5e73\\u53f0\",\"short_link\":\"\\u77ed\\u94fe\\u63a5\",\"status\":\"\\u72b6\\u6001\",\"deleted\":\"deleted\"},\"search\":[\"merchant_id\",\"order_code\",\"link_type\",\"status\"],\"require\":[\"merchant_id\",\"order_code\",\"link_type\",\"short_link\",\"status\"],\"form_type\":{\"merchant_id\":\"input\",\"order_code\":\"input\",\"link_type\":\"radio\",\"short_link\":\"input\",\"status\":\"radio\"},\"dict\":{\"merchant_id\":\"\",\"order_code\":\"\",\"link_type\":\"sys_link_type\",\"short_link\":\"\",\"status\":\"sys_normal_disable\"}}', '127.0.0.1', 1735127286, 0);
INSERT INTO `lh_system_log` VALUES (678, 'admin', '/admin/dict/save', '/admin/dict/save', '{\"id\":\"111\",\"dict_label\":\"BOSS\",\"dict_value\":\"boss\",\"dict_sort\":\"1\",\"dict_type\":\"sys_link_type\",\"css_class\":\"\",\"list_class\":\"default\",\"is_default\":\"1\",\"status\":\"1\",\"remark\":\"BOSS\\u77ed\\u94fe\"}', '127.0.0.1', 1735130890, 0);
INSERT INTO `lh_system_log` VALUES (679, 'admin', '/admin/dictType/save', '/admin/dictType/save', '{\"dict_name\":\"\\u7c89\\u4e1d\\u7c7b\\u578b\",\"dict_type\":\"sys_fans_type\",\"status\":\"1\",\"remark\":\"\\u7c89\\u4e1d\\u7c7b\\u578b\"}', '127.0.0.1', 1735195517, 0);
INSERT INTO `lh_system_log` VALUES (680, 'admin', '/admin/dict/save', '/admin/dict/save', '{\"dict_label\":\"\\u65b0\\u7c89\",\"dict_value\":\"1\",\"dict_sort\":\"1\",\"dict_type\":\"sys_fans_type\",\"css_class\":\"\",\"list_class\":\"default\",\"is_default\":\"1\",\"status\":\"1\",\"remark\":\"\\u65b0\\u7c89\"}', '127.0.0.1', 1735195541, 0);
INSERT INTO `lh_system_log` VALUES (681, 'admin', '/admin/dict/save', '/admin/dict/save', '{\"dict_label\":\"\\u8001\\u7c89\",\"dict_value\":\"2\",\"dict_sort\":\"2\",\"dict_type\":\"sys_fans_type\",\"css_class\":\"\",\"list_class\":\"default\",\"is_default\":\"0\",\"status\":\"1\",\"remark\":\"\"}', '127.0.0.1', 1735195556, 0);
INSERT INTO `lh_system_log` VALUES (682, 'admin', '/admin/crud/save', '/admin/crud/save', '{\"table_name\":\"work_order_fans\",\"app_name\":\"merchant\",\"is_view\":\"1\",\"is_node\":\"1\",\"node\":{\"parent_id\":\"1071\",\"title\":\"\\u7c89\\u4e1d\\u7ba1\\u7406\",\"sort\":\"60\"},\"comment\":{\"id\":\"id\",\"merchant_id\":\"\\u5546\\u6237ID\",\"active_code\":\"\\u6fc0\\u6d3b\\u7801\",\"order_code\":\"\\u5de5\\u5355\\u7f16\\u53f7\",\"order_account_id\":\"\\u4e3b\\u5e10\\u53f7\",\"fans_account_code\":\"\\u7528\\u6237\\u540d\",\"fans_mobile\":\"\\u624b\\u673a\\u53f7\",\"fans_account_id\":\"\\u8d26\\u6237ID\",\"fans_account_name\":\"\\u8d26\\u6237\\u540d\\u79f0\",\"fans_type\":\"\\u7c89\\u4e1d\\u7c7b\\u578b\",\"fans_flag\":\"\\u7c89\\u4e1d\\u6807\\u7b7e\",\"country\":\"\\u56fd\\u5bb6\",\"create_time\":\"\\u521b\\u5efa\\u65f6\\u95f4\",\"remark\":\"\\u5907\\u6ce8\",\"deleted\":\"deleted\"},\"search\":[\"merchant_id\",\"active_code\",\"order_code\",\"order_account_id\",\"fans_account_code\"],\"require\":[\"merchant_id\",\"active_code\",\"order_code\",\"order_account_id\",\"fans_account_code\",\"fans_mobile\",\"fans_account_id\",\"fans_account_name\"],\"form_type\":{\"merchant_id\":\"input\",\"active_code\":\"input\",\"order_code\":\"input\",\"order_account_id\":\"input\",\"fans_account_code\":\"input\",\"fans_mobile\":\"input\",\"fans_account_id\":\"input\",\"fans_account_name\":\"input\",\"fans_type\":\"radio\",\"fans_flag\":\"input\",\"country\":\"input\",\"create_time\":\"input\",\"remark\":\"textarea\"},\"dict\":{\"merchant_id\":\"\",\"active_code\":\"\",\"order_code\":\"\",\"order_account_id\":\"\",\"fans_account_code\":\"\",\"fans_mobile\":\"\",\"fans_account_id\":\"\",\"fans_account_name\":\"\",\"fans_type\":\"sys_fans_type\",\"fans_flag\":\"\",\"country\":\"\",\"create_time\":\"\",\"remark\":\"\"}}', '127.0.0.1', 1735195640, 0);
INSERT INTO `lh_system_log` VALUES (683, 'admin', '/admin/crud/save', '/admin/crud/save', '{\"table_name\":\"keyword\",\"app_name\":\"merchant\",\"is_view\":\"1\",\"is_node\":\"1\",\"node\":{\"parent_id\":\"1073\",\"title\":\"\\u5173\\u952e\\u8bcd\\u7ba1\\u7406\",\"sort\":\"99\"},\"comment\":{\"id\":\"id\",\"merchant_id\":\"merchant_id\",\"keyword\":\"\\u654f\\u611f\\u8bcd\",\"keyword_type\":\"\\u5206\\u7c7b\",\"is_refuse\":\"\\u62d2\\u7edd\\u53d1\\u9001\"},\"form_type\":{\"merchant_id\":\"input\",\"keyword\":\"input\",\"keyword_type\":\"input\",\"is_refuse\":\"input\"},\"dict\":{\"merchant_id\":\"\",\"keyword\":\"\",\"keyword_type\":\"\",\"is_refuse\":\"\"}}', '127.0.0.1', 1735207572, 0);
INSERT INTO `lh_system_log` VALUES (684, 'admin', '/admin/crud/save', '/admin/crud/save', '{\"table_name\":\"keyword\",\"app_name\":\"merchant\",\"is_view\":\"1\",\"is_node\":\"1\",\"node\":{\"parent_id\":\"1073\",\"title\":\"\\u5173\\u952e\\u8bcd\\u7ba1\\u7406\",\"sort\":\"99\"},\"comment\":{\"id\":\"id\",\"merchant_id\":\"merchant_id\",\"keyword\":\"\\u654f\\u611f\\u8bcd\",\"keyword_type\":\"\\u5206\\u7c7b\",\"is_refuse\":\"\\u62d2\\u7edd\\u53d1\\u9001\"},\"search\":[\"merchant_id\",\"keyword\",\"keyword_type\"],\"form_type\":{\"merchant_id\":\"input\",\"keyword\":\"input\",\"keyword_type\":\"input\",\"is_refuse\":\"radio\"},\"dict\":{\"merchant_id\":\"\",\"keyword\":\"\",\"keyword_type\":\"\",\"is_refuse\":\"sys_yes_no\"},\"require\":[\"keyword\",\"keyword_type\"]}', '127.0.0.1', 1735207601, 0);
INSERT INTO `lh_system_log` VALUES (685, 'admin', '/admin/crud/save', '/admin/crud/save', '{\"table_name\":\"keyword\",\"app_name\":\"merchant\",\"is_view\":\"1\",\"is_node\":\"1\",\"node\":{\"parent_id\":\"\",\"title\":\"\",\"sort\":\"\"},\"comment\":{\"id\":\"id\",\"merchant_id\":\"\\u5546\\u6237ID\",\"keyword\":\"\\u654f\\u611f\\u8bcd\",\"keyword_type\":\"\\u5206\\u7c7b\",\"is_refuse\":\"\\u62d2\\u7edd\\u53d1\\u9001\",\"create_time\":\"\\u521b\\u5efa\\u65f6\\u95f4\"},\"search\":[\"merchant_id\",\"keyword\",\"keyword_type\",\"is_refuse\"],\"require\":[\"merchant_id\",\"keyword\",\"keyword_type\",\"is_refuse\"],\"form_type\":{\"merchant_id\":\"input\",\"keyword\":\"input\",\"keyword_type\":\"input\",\"is_refuse\":\"radio\",\"create_time\":\"input\"},\"dict\":{\"merchant_id\":\"\",\"keyword\":\"\",\"keyword_type\":\"\",\"is_refuse\":\"sys_yes_no\",\"create_time\":\"\"}}', '127.0.0.1', 1735207754, 0);
INSERT INTO `lh_system_log` VALUES (686, 'admin', '/admin/crud/save', '/admin/crud/save', '{\"table_name\":\"keyword_type\",\"app_name\":\"merchant\",\"is_view\":\"1\",\"is_node\":\"1\",\"node\":{\"parent_id\":\"\",\"title\":\"\",\"sort\":\"\"},\"comment\":{\"id\":\"id\",\"merchant_id\":\"\\u6240\\u5c5e\\u5546\\u6237\",\"type_name\":\"\\u5206\\u7c7b\\u540d\\u79f0\"},\"search\":[\"merchant_id\",\"type_name\"],\"require\":[\"merchant_id\",\"type_name\"],\"form_type\":{\"merchant_id\":\"input\",\"type_name\":\"input\"},\"dict\":{\"merchant_id\":\"\",\"type_name\":\"\"}}', '127.0.0.1', 1735207812, 0);
INSERT INTO `lh_system_log` VALUES (687, 'admin', '/admin/crud/save', '/admin/crud/save', '{\"table_name\":\"keyword_type\",\"app_name\":\"merchant\",\"is_view\":\"1\",\"is_node\":\"1\",\"node\":{\"parent_id\":\"\",\"title\":\"\",\"sort\":\"\"},\"comment\":{\"id\":\"id\",\"merchant_id\":\"\\u6240\\u5c5e\\u5546\\u6237\",\"type_name\":\"\\u5206\\u7c7b\\u540d\\u79f0\"},\"search\":[\"merchant_id\",\"type_name\"],\"form_type\":{\"merchant_id\":\"input\",\"type_name\":\"input\"},\"dict\":{\"merchant_id\":\"\",\"type_name\":\"\"},\"require\":[\"type_name\"]}', '127.0.0.1', 1735207816, 0);
INSERT INTO `lh_system_log` VALUES (688, 'admin', '/admin/crud/save', '/admin/crud/save', '{\"table_name\":\"keyword_type\",\"app_name\":\"merchant\",\"is_view\":\"1\",\"is_node\":\"1\",\"node\":{\"parent_id\":\"1073\",\"title\":\"\\u654f\\u611f\\u8bcd\\u5206\\u7c7b\",\"sort\":\"60\"},\"comment\":{\"id\":\"id\",\"merchant_id\":\"\\u6240\\u5c5e\\u5546\\u6237\",\"type_name\":\"\\u5206\\u7c7b\\u540d\\u79f0\"},\"form_type\":{\"merchant_id\":\"input\",\"type_name\":\"input\"},\"dict\":{\"merchant_id\":\"\",\"type_name\":\"\"}}', '127.0.0.1', 1735207835, 0);
INSERT INTO `lh_system_log` VALUES (689, 'admin', '/admin/crud/save', '/admin/crud/save', '{\"table_name\":\"keyword_type\",\"app_name\":\"merchant\",\"is_view\":\"1\",\"is_node\":\"1\",\"node\":{\"parent_id\":\"1073\",\"title\":\"\\u654f\\u611f\\u8bcd\\u5206\\u7c7b\",\"sort\":\"60\"},\"comment\":{\"id\":\"id\",\"merchant_id\":\"\\u6240\\u5c5e\\u5546\\u6237\",\"type_name\":\"\\u5206\\u7c7b\\u540d\\u79f0\"},\"search\":[\"merchant_id\",\"type_name\"],\"form_type\":{\"merchant_id\":\"input\",\"type_name\":\"input\"},\"dict\":{\"merchant_id\":\"\",\"type_name\":\"\"},\"require\":[\"type_name\"]}', '127.0.0.1', 1735207899, 0);
INSERT INTO `lh_system_log` VALUES (690, 'admin', '/admin/crud/save', '/admin/crud/save', '{\"table_name\":\"keyword_type\",\"app_name\":\"merchant\",\"is_view\":\"1\",\"is_node\":\"1\",\"node\":{\"parent_id\":\"1073\",\"title\":\"\\u654f\\u611f\\u8bcd\\u5206\\u7c7b\",\"sort\":\"60\"},\"comment\":{\"id\":\"id\",\"merchant_id\":\"\\u6240\\u5c5e\\u5546\\u6237\",\"type_name\":\"\\u5206\\u7c7b\\u540d\\u79f0\"},\"search\":[\"merchant_id\",\"type_name\"],\"form_type\":{\"merchant_id\":\"input\",\"type_name\":\"input\"},\"dict\":{\"merchant_id\":\"\",\"type_name\":\"\"},\"require\":[\"type_name\"]}', '127.0.0.1', 1735208265, 0);
INSERT INTO `lh_system_log` VALUES (691, 'admin', '/admin/crud/save', '/admin/crud/save', '{\"table_name\":\"keyword_type\",\"app_name\":\"merchant\",\"is_view\":\"1\",\"is_node\":\"1\",\"node\":{\"parent_id\":\"\",\"title\":\"\",\"sort\":\"\"},\"comment\":{\"id\":\"id\",\"merchant_id\":\"\\u6240\\u5c5e\\u5546\\u6237\",\"type_name\":\"\\u5206\\u7c7b\\u540d\\u79f0\"},\"search\":[\"merchant_id\",\"type_name\"],\"form_type\":{\"merchant_id\":\"no\",\"type_name\":\"input\"},\"dict\":{\"merchant_id\":\"\",\"type_name\":\"\"},\"require\":[\"type_name\"]}', '127.0.0.1', 1735208340, 0);
INSERT INTO `lh_system_log` VALUES (692, 'admin', '/admin/crud/save', '/admin/crud/save', '{\"table_name\":\"keyword\",\"app_name\":\"merchant\",\"is_view\":\"1\",\"is_node\":\"1\",\"node\":{\"parent_id\":\"\",\"title\":\"\",\"sort\":\"\"},\"comment\":{\"id\":\"id\",\"merchant_id\":\"merchant_id\",\"keyword\":\"\\u654f\\u611f\\u8bcd\",\"keyword_type\":\"\\u5206\\u7c7b\",\"is_refuse\":\"\\u62d2\\u7edd\\u53d1\\u9001\",\"create_time\":\"\\u521b\\u5efa\\u65f6\\u95f4\"},\"search\":[\"merchant_id\",\"keyword\",\"keyword_type\",\"is_refuse\"],\"form_type\":{\"merchant_id\":\"no\",\"keyword\":\"input\",\"keyword_type\":\"input\",\"is_refuse\":\"radio\",\"create_time\":\"input\"},\"dict\":{\"merchant_id\":\"\",\"keyword\":\"\",\"keyword_type\":\"\",\"is_refuse\":\"sys_yes_no\",\"create_time\":\"\"},\"require\":[\"keyword\",\"keyword_type\",\"is_refuse\"]}', '127.0.0.1', 1735208595, 0);
INSERT INTO `lh_system_log` VALUES (693, 'admin', '/admin/crud/save', '/admin/crud/save', '{\"table_name\":\"resource_type\",\"app_name\":\"merchant\",\"is_view\":\"1\",\"is_node\":\"1\",\"node\":{\"parent_id\":\"1073\",\"title\":\"\\u7d20\\u6750\\u7c7b\\u578b\",\"sort\":\"30\"},\"comment\":{\"id\":\"id\",\"merchant_id\":\"\\u6240\\u5c5e\\u5546\\u6237\",\"type_name\":\"\\u5206\\u7c7b\\u540d\\u79f0\"},\"search\":[\"merchant_id\",\"type_name\"],\"require\":[\"merchant_id\",\"type_name\"],\"form_type\":{\"merchant_id\":\"select\",\"type_name\":\"radio\"},\"dict\":{\"merchant_id\":\"sys_fans_type\",\"type_name\":\"sys_port_status\"}}', '127.0.0.1', 1735440295, 0);
INSERT INTO `lh_system_log` VALUES (694, 'admin', '/admin/crud/save', '/admin/crud/save', '{\"table_name\":\"resource_type\",\"app_name\":\"merchant\",\"is_view\":\"1\",\"is_node\":\"1\",\"node\":{\"parent_id\":\"1073\",\"title\":\"\\u7d20\\u6750\\u7c7b\\u578b\",\"sort\":\"30\"},\"comment\":{\"id\":\"id\",\"merchant_id\":\"\\u6240\\u5c5e\\u5546\\u6237\",\"type_name\":\"\\u5206\\u7c7b\\u540d\\u79f0\"},\"search\":[\"merchant_id\",\"type_name\"],\"require\":[\"merchant_id\",\"type_name\"],\"form_type\":{\"merchant_id\":\"input\",\"type_name\":\"input\"},\"dict\":{\"merchant_id\":\"\",\"type_name\":\"\"}}', '127.0.0.1', 1735440354, 0);

-- ----------------------------
-- Table structure for lh_translate_engine
-- ----------------------------
DROP TABLE IF EXISTS `lh_translate_engine`;
CREATE TABLE `lh_translate_engine`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `engine_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '引擎名称',
  `engine_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '引擎编码',
  `engine_type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '引擎类型',
  `engine_sort` tinyint(3) NOT NULL DEFAULT 0 COMMENT '引擎排序',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '翻译引擎' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lh_translate_engine
-- ----------------------------
INSERT INTO `lh_translate_engine` VALUES (1, '谷歌', 'google', 'general', 99, 1, 0);
INSERT INTO `lh_translate_engine` VALUES (2, '百度', 'baidu', 'general', 90, 1, 0);
INSERT INTO `lh_translate_engine` VALUES (3, '有道', 'youdao', 'general', 80, 1, 0);
INSERT INTO `lh_translate_engine` VALUES (4, 'openai', 'openai', 'profession', 70, 1, 0);
INSERT INTO `lh_translate_engine` VALUES (5, '豆包', 'doubao', 'profession', 60, 1, 0);

-- ----------------------------
-- Table structure for lh_user
-- ----------------------------
DROP TABLE IF EXISTS `lh_user`;
CREATE TABLE `lh_user`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '登入账号',
  `password` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '登录密码',
  `salt` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '密码盐',
  `realname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '真实姓名',
  `mobile` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '电话',
  `token` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '身份标识',
  `role_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '角色id',
  `last_login_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后登录时间',
  `last_login_ip` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后登录IP',
  `fail_times` tinyint(4) NOT NULL DEFAULT 0 COMMENT '登录失败次数',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '状态1正常 0 禁用',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `deleted` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否删除0 未删除 1已删除',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '系统管理员表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lh_user
-- ----------------------------
INSERT INTO `lh_user` VALUES (1, 'admin', '14bc48527b1c5376b524a5b24a797444', 'SyFLZk', 'admin', '1235566333', '7013cbffe9642c556c41fae0907abf6c', 1, 1735439613, 2130706433, 2, 1, 1646318413, 0);

-- ----------------------------
-- Table structure for lh_user_log
-- ----------------------------
DROP TABLE IF EXISTS `lh_user_log`;
CREATE TABLE `lh_user_log`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT 0 COMMENT '用户ID',
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户名',
  `ip` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 60 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lh_user_log
-- ----------------------------
INSERT INTO `lh_user_log` VALUES (1, 2, 'choeon@admin', '172.71.211.28', 1692553265, 0);
INSERT INTO `lh_user_log` VALUES (2, 2, 'choeon@admin', '172.71.214.53', 1692554378, 0);
INSERT INTO `lh_user_log` VALUES (3, 2, 'choeon@admin', '172.71.218.196', 1692777228, 0);
INSERT INTO `lh_user_log` VALUES (4, 2, 'choeon@admin', '172.71.218.184', 1692784197, 0);
INSERT INTO `lh_user_log` VALUES (5, 2, 'choeon@admin', '172.71.210.234', 1692959485, 0);
INSERT INTO `lh_user_log` VALUES (6, 2, 'choeon@admin', '172.71.215.42', 1693245990, 0);
INSERT INTO `lh_user_log` VALUES (7, 2, 'choeon@admin', '172.71.210.54', 1693302988, 0);
INSERT INTO `lh_user_log` VALUES (8, 2, 'choeon@admin', '172.71.218.88', 1693554048, 0);
INSERT INTO `lh_user_log` VALUES (9, 2, 'choeon@admin', '162.158.179.136', 1693813676, 0);
INSERT INTO `lh_user_log` VALUES (10, 2, 'choeon@admin', '172.71.214.222', 1694246314, 0);
INSERT INTO `lh_user_log` VALUES (11, 2, 'choeon@admin', '172.71.218.59', 1694332758, 0);
INSERT INTO `lh_user_log` VALUES (12, 2, 'choeon@admin', '172.71.218.38', 1694418996, 0);
INSERT INTO `lh_user_log` VALUES (13, 2, 'choeon@admin', '162.158.178.103', 1694677656, 0);
INSERT INTO `lh_user_log` VALUES (14, 2, 'choeon@admin', '172.71.215.77', 1694677989, 0);
INSERT INTO `lh_user_log` VALUES (15, 2, 'choeon@admin', '172.71.215.78', 1694678109, 0);
INSERT INTO `lh_user_log` VALUES (16, 2, 'choeon@admin', '172.71.215.77', 1694678123, 0);
INSERT INTO `lh_user_log` VALUES (17, 2, 'choeon@admin', '172.71.210.189', 1694763873, 0);
INSERT INTO `lh_user_log` VALUES (18, 2, 'choeon@admin', '162.158.178.81', 1694775699, 0);
INSERT INTO `lh_user_log` VALUES (19, 2, 'choeon@admin', '172.71.218.63', 1694853708, 0);
INSERT INTO `lh_user_log` VALUES (20, 2, 'choeon@admin', '162.158.106.194', 1694881537, 0);
INSERT INTO `lh_user_log` VALUES (21, 1, 'admin', '127.0.0.1', 1729579149, 0);
INSERT INTO `lh_user_log` VALUES (22, 1, 'admin', '172.70.189.120', 1729604228, 0);
INSERT INTO `lh_user_log` VALUES (23, 1, 'admin', '172.69.134.254', 1729649873, 0);
INSERT INTO `lh_user_log` VALUES (24, 1, 'admin', '162.158.179.132', 1729666974, 0);
INSERT INTO `lh_user_log` VALUES (25, 1, 'admin', '162.158.186.57', 1729694220, 0);
INSERT INTO `lh_user_log` VALUES (26, 1, 'admin', '162.158.190.40', 1729741313, 0);
INSERT INTO `lh_user_log` VALUES (27, 1, 'admin', '162.158.190.43', 1729779751, 0);
INSERT INTO `lh_user_log` VALUES (28, 1, 'admin', '172.70.142.254', 1729850123, 0);
INSERT INTO `lh_user_log` VALUES (29, 1, 'admin', '162.158.90.208', 1732085008, 0);
INSERT INTO `lh_user_log` VALUES (30, 1, 'admin', '172.71.218.212', 1732348081, 0);
INSERT INTO `lh_user_log` VALUES (31, 1, 'admin', '162.158.189.192', 1732527871, 0);
INSERT INTO `lh_user_log` VALUES (32, 1, 'admin', '162.158.179.132', 1732527902, 0);
INSERT INTO `lh_user_log` VALUES (33, 1, 'admin', '172.71.211.18', 1732635037, 0);
INSERT INTO `lh_user_log` VALUES (34, 1, 'admin', '172.68.225.211', 1732673145, 0);
INSERT INTO `lh_user_log` VALUES (35, 1, 'admin', '172.70.143.237', 1732760622, 0);
INSERT INTO `lh_user_log` VALUES (36, 1, 'admin', '108.162.226.166', 1732807588, 0);
INSERT INTO `lh_user_log` VALUES (37, 1, 'admin', '127.0.0.1', 1734435219, 0);
INSERT INTO `lh_user_log` VALUES (38, 1, 'admin', '127.0.0.1', 1734449838, 0);
INSERT INTO `lh_user_log` VALUES (39, 1, 'admin', '127.0.0.1', 1734485489, 0);
INSERT INTO `lh_user_log` VALUES (40, 1, 'admin', '127.0.0.1', 1734576662, 0);
INSERT INTO `lh_user_log` VALUES (41, 1, 'admin', '127.0.0.1', 1734659546, 0);
INSERT INTO `lh_user_log` VALUES (42, 1, 'admin', '127.0.0.1', 1734674837, 0);
INSERT INTO `lh_user_log` VALUES (43, 1, 'admin', '127.0.0.1', 1734685826, 0);
INSERT INTO `lh_user_log` VALUES (44, 1, 'admin', '127.0.0.1', 1734701165, 0);
INSERT INTO `lh_user_log` VALUES (45, 1, 'admin', '127.0.0.1', 1734746520, 0);
INSERT INTO `lh_user_log` VALUES (46, 1, 'admin', '127.0.0.1', 1734752030, 0);
INSERT INTO `lh_user_log` VALUES (47, 1, 'admin', '127.0.0.1', 1734760833, 0);
INSERT INTO `lh_user_log` VALUES (48, 1, 'admin', '127.0.0.1', 1734916492, 0);
INSERT INTO `lh_user_log` VALUES (49, 1, 'admin', '127.0.0.1', 1734947661, 0);
INSERT INTO `lh_user_log` VALUES (50, 1, 'admin', '127.0.0.1', 1735008128, 0);
INSERT INTO `lh_user_log` VALUES (51, 1, 'admin', '127.0.0.1', 1735024486, 0);
INSERT INTO `lh_user_log` VALUES (52, 1, 'admin', '127.0.0.1', 1735096386, 0);
INSERT INTO `lh_user_log` VALUES (53, 1, 'admin', '127.0.0.1', 1735107051, 0);
INSERT INTO `lh_user_log` VALUES (54, 1, 'admin', '127.0.0.1', 1735125778, 0);
INSERT INTO `lh_user_log` VALUES (55, 1, 'admin', '127.0.0.1', 1735125838, 0);
INSERT INTO `lh_user_log` VALUES (56, 1, 'admin', '127.0.0.1', 1735176755, 0);
INSERT INTO `lh_user_log` VALUES (57, 1, 'admin', '127.0.0.1', 1735195396, 0);
INSERT INTO `lh_user_log` VALUES (58, 1, 'admin', '127.0.0.1', 1735207535, 0);
INSERT INTO `lh_user_log` VALUES (59, 1, 'admin', '127.0.0.1', 1735439613, 0);

-- ----------------------------
-- Table structure for lh_work_order
-- ----------------------------
DROP TABLE IF EXISTS `lh_work_order`;
CREATE TABLE `lh_work_order`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL DEFAULT 0 COMMENT '商户ID',
  `order_code` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '工单编号',
  `active_code` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '激活码',
  `order_name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '工单名称',
  `platform` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '工单类型',
  `port_num` smallint(5) NOT NULL COMMENT '端口数',
  `port_use_num` smallint(5) NOT NULL DEFAULT 0 COMMENT '使用端口',
  `port_online_num` smallint(5) NOT NULL DEFAULT 0 COMMENT '在线端口',
  `fans_target_num` int(10) NOT NULL DEFAULT 0 COMMENT '目标总数',
  `fans_num` int(10) NOT NULL DEFAULT 0 COMMENT '进粉总数',
  `fans_repeat_num` int(10) NOT NULL DEFAULT 0 COMMENT '重复粉数',
  `today_fans_num` int(10) NOT NULL DEFAULT 0 COMMENT '当日进粉数',
  `clean_time` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '清零时间',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态',
  `create_user` int(11) NOT NULL DEFAULT 0 COMMENT '创建人',
  `create_time` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `member_id`(`merchant_id`) USING BTREE,
  INDEX `order_sn`(`active_code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lh_work_order
-- ----------------------------
INSERT INTO `lh_work_order` VALUES (1, 1, 'GD123456', '88888', 'whatsapp', 'whatsapp', 10, 0, 0, 100, 0, 0, 0, '10:00', 0, 0, 1734449982, 0);
INSERT INTO `lh_work_order` VALUES (8, 2, 'GD2412240014', 'EFHVNGPGQU', 'whatsapp', 'whatsapp', 5, 1, 0, 0, 0, 0, 0, '', 1, 1, 1735037298, 0);
INSERT INTO `lh_work_order` VALUES (9, 2, 'GD2412240015', 'EFHVNGPGQU', 'telegram', 'telegram', 5, 1, 0, 0, 0, 0, 0, '', 1, 1, 1735037298, 0);
INSERT INTO `lh_work_order` VALUES (10, 2, 'GD2412240016', 'CTGZBD7TUQ', 'whatsapp', 'whatsapp', 4, 0, 0, 0, 0, 0, 0, '10:00', 1, 0, 1735042084, 0);
INSERT INTO `lh_work_order` VALUES (11, 2, 'GD2412240017', 'CTGZBD7TUQ', 'telegram', 'telegram', 4, 0, 0, 0, 0, 0, 0, '10:00', 1, 1, 1735042084, 0);

-- ----------------------------
-- Table structure for lh_work_order_account
-- ----------------------------
DROP TABLE IF EXISTS `lh_work_order_account`;
CREATE TABLE `lh_work_order_account`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL DEFAULT 0 COMMENT '商户ID',
  `active_code` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '激活码',
  `order_code` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '工单编号',
  `account_code` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `account_mobile` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '手机号',
  `account_name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '账户名称',
  `account_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '账户ID',
  `online_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '在线状态',
  `port_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '端口状态',
  `fans_target_num` int(10) NOT NULL DEFAULT 0 COMMENT '目标总数',
  `fans_num` int(10) NOT NULL DEFAULT 0 COMMENT '进粉总数',
  `today_fans_repeat_num` int(11) NOT NULL DEFAULT 0 COMMENT '当日重复粉数',
  `fans_repeat_num` int(10) NOT NULL DEFAULT 0 COMMENT '重复粉数',
  `today_fans_num` int(10) NOT NULL DEFAULT 0 COMMENT '当日进粉数',
  `today_fans_target_num` int(10) NOT NULL DEFAULT 0 COMMENT '当日进粉目标',
  `online_time` int(10) NOT NULL DEFAULT 0 COMMENT '上线时间',
  `offline_time` int(10) NOT NULL DEFAULT 0 COMMENT '下线时间',
  `account_link` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '主号连接',
  `remark` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  `create_time` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `token` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户token',
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lh_work_order_account
-- ----------------------------
INSERT INTO `lh_work_order_account` VALUES (1, 1, ' 88888', 'GD123456', 'xiaohuozi', '62121212121', '', 6666666666, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, '', 0);

-- ----------------------------
-- Table structure for lh_work_order_branch
-- ----------------------------
DROP TABLE IF EXISTS `lh_work_order_branch`;
CREATE TABLE `lh_work_order_branch`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL DEFAULT 0 COMMENT '商户ID',
  `order_code` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '工单编号',
  `link_type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '短链平台',
  `short_link` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '短链接',
  `click_num` int(11) NOT NULL COMMENT '点击数',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lh_work_order_branch
-- ----------------------------
INSERT INTO `lh_work_order_branch` VALUES (1, 2, 'GD2412240017', 'boss', 'http://lhs.cc/share/GD2412240017', 0, 1, 0);

-- ----------------------------
-- Table structure for lh_work_order_fans
-- ----------------------------
DROP TABLE IF EXISTS `lh_work_order_fans`;
CREATE TABLE `lh_work_order_fans`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL DEFAULT 0 COMMENT '商户ID',
  `active_code` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '激活码',
  `order_code` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '工单编号',
  `order_account_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '主帐号',
  `fans_account_code` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `fans_mobile` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '手机号',
  `fans_account_id` bigint(20) NOT NULL DEFAULT 0 COMMENT '账户ID',
  `fans_account_name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '账户名称',
  `fans_type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '粉丝类型',
  `fans_flag` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '粉丝标签',
  `country` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '国家',
  `create_time` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `reset_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '重置状态 1 已重置 0 未重置',
  `remark` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '备注',
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lh_work_order_fans
-- ----------------------------
INSERT INTO `lh_work_order_fans` VALUES (1, 1, ' 88888', 'GD123456', 'xiaohuozi', '', '62121212121', 6666666666, '', '', '', '', 0, 0, '', 0);

-- ----------------------------
-- Table structure for lh_work_order_share
-- ----------------------------
DROP TABLE IF EXISTS `lh_work_order_share`;
CREATE TABLE `lh_work_order_share`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL COMMENT '商户ID',
  `order_code` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '工单编号',
  `link_type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '短链平台',
  `expire_time` int(10) NOT NULL COMMENT '到期时间',
  `password` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分享密码',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lh_work_order_share
-- ----------------------------
INSERT INTO `lh_work_order_share` VALUES (1, 2, 'GD2412240017', 'boss', 1735488000, '66666', 1, 0);
INSERT INTO `lh_work_order_share` VALUES (2, 2, 'GD2412240016', 'boss', 1735419600, 'QCdKtb', 1, 0);
INSERT INTO `lh_work_order_share` VALUES (3, 2, 'GD2412240015', 'boss', 1735315200, 'BUEsbi', 1, 0);

SET FOREIGN_KEY_CHECKS = 1;
