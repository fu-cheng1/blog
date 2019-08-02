package com.itzijin.domain;

import lombok.Data;

import javax.persistence.Id;
import javax.persistence.Table;

/**
 * @Author: 陈尚宇
 * @Date: 2019/8/2 17:26
 * Function:
 */
@Data
@Table(name = "wenzhang")
public class Article {

    @Id
    private String id;
    private String title;
    private String content;
    private String username;
    private String fenlei;
    private String create_date;
    private String liulanliang;
    private String pinglun;

}
