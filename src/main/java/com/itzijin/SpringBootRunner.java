package com.itzijin;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import tk.mybatis.spring.annotation.MapperScan;

/**
 * @Author: 陈尚宇
 * @Date: 2019/8/2 17:28
 * Function:
 */
@SpringBootApplication
@MapperScan("com.itzijin.dao")
public class SpringBootRunner {

    public static void main(String[] args) {
        SpringApplication.run(SpringBootRunner.class, args);
    }
}
